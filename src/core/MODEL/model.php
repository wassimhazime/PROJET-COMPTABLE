<?php
namespace core\model;
use core\model\base_donnee\database;
use core\model\entitys\entity;
use core\model\table\table;
use \PDO;
use \PDOException;


use core\notify\notify;

class model {
    private $db;
    public $table;
    public $entity;
    

            
    public function __construct( $table, $db = null) {

        
        $this->table = new table($table);
        $this->entity=new entity(); 
        if ($db === null) {
            $this->db = database::getDB();
        } else {
            $this->db = $db;
        }
    }
    
    public function requete($sql, $select = true) {
      
        try {
            if ($select) {
                $Statement = $this->db->query($sql);
                
                $Statement->setFetchMode( PDO::FETCH_CLASS, get_class($this->entity));
                
               
            return $Statement->fetchAll();
           } else {
                 $this->db->exec($sql);
                 return $this->db->lastInsertId(); 
            }
        } catch (PDOException $exc) {
            notify::send_Notify($exc->getMessage());
        }
    }
    
    public function setData($data,$relation=null) {
        unset($data['ajout_data']);

        $dataRelation = null;
       
        if ($relation != null) {
            if (is_array($relation)) {
                foreach ($relation as $RD) {
                    if (isset($data[$RD])) {
                        $nomTableRelation[$RD] = 'd_' . $this->table->getNom() . '_' . $RD;
                        $dataRelation[$RD] = $data[$RD];
                        $RL[]=$RD;
                        unset($data[$RD]);
                    }
                }
            } else {
                $nomTableRelation = 'd_' . $this->table->getNom() . '_' . $relation; //exemple d_facture_bl
                $dataRelation = $data[$relation];
                unset($data[$relation]);
            }
        }
        $id = 'id_' . $this->table->getNom();

        if ($data[$id] == '') {

            $idPere = $this->requete($this->table->insert($data), false);
            
            if ($dataRelation != null) {
                if (is_array($RL)) {
                    
                    foreach ($RL as $RD) {
                        
                        foreach ($dataRelation[$RD] as $enfant) {
                            $item=null;
                            $item[$id . '_detail'] = $idPere;
                            $item['id_' . $RD . '_detail'] = $enfant;
                            
                            $this->requete($this->table->insert($item, $nomTableRelation[$RD]), false);
                        }
                    }
                } else {
                    foreach ($dataRelation as $enfant) {
                        $item[$id . '_detail'] = $idPere;
                        $item['id_' . $relation . '_detail'] = $enfant;
                        $this->requete($this->table->insert($item, $nomTableRelation), false);
                    }
                }
            }
        } else {
            
             $this->requete($this->table->update($data), false);
        }

       
    }

    public function getData($condition,$link,$select) { // error
     if ($condition == null or isset($condition['vide-null']) )
         {return null;}
    $sql= $this->table->select($select, $condition);
    $sql = str_replace($link.':', '', $sql);
         return $this->requete($sql);
           
    }
    
    
    
    
    
    
    public function getTableSQLrelation( $tableEnfant,$selectEnfant,$selectPere = null) {
         $TABLEpere=$this->table->getNom();
         $datapere= $this->getTableSQL($selectPere,$TABLEpere);
         $idpere='id_'.$TABLEpere;

        foreach ($datapere as $row) {
            for ($index = 0; $index < count($tableEnfant); $index++) {
            $sql = $this->table->join($selectEnfant[$index],$TABLEpere,$tableEnfant[$index],$row->$idpere);
            
            $row->setEnfant($tableEnfant[$index],$this->requete($sql));  
            }
        }
        return $datapere;
    }
    
    public function getTableSQL($colunne = null, $table = null,$condition=null) {
        if ($colunne == null) {$colunne = $this->getSelectColunneImportant(null,$table);}
        $sql = $this->table->select($colunne, $condition, $table);
        $data = $this->requete($sql);

        //si les champs de la table et vide  
        if ($data == null) {
            $sql = $this->table->selectSchema($table);
            $data = $this->requete($sql);
            $entity = new entity();
            $table = array();
            foreach ($data as $value) {
                $entity->{$value->COLUMN_NAME} = 'vide';
            }
           return array($entity);
        }

          return $data;
          
    }
   
    
    
    public function getTableSQL_Orphelin($colunne = null,$TABLEpere=null,$TABLEenfant=null) {
      if ($colunne == null) {$colunne = $this->getSelectColunneImportant(null,$TABLEenfant);}  
      $sql = $this->table->joinOrphelins($colunne, $TABLEpere, $TABLEenfant);
        $data = $this->requete($sql);
          //si les champs de la table et vide  
        if ($data == null) {
            $sql = $this->table->selectSchema($TABLEenfant);
            $data = $this->requete($sql);
            $entity = new entity();
            $table = array();
            foreach ($data as $value) {
                $entity->{$value->COLUMN_NAME} = '';
            }
           return array($entity);
        }

          return $data;
    }

    
    
    
    
    
    
    
    
    
    
    
    public function getMetaFORM() {
        $metaform = array();
        
       
        $metaform['meta'] = $this->getMetaTable();

        foreach ($this->getMetaTable() as $champ) {
            if ($champ->Key == 'MUL') {
                $len=strlen($this->table->getNom());
                $delete=($len+1)*-1;
                $table = substr($champ->Field, 0, $delete);
                //$table= str_replace('_'.$this->table->getNom(), '', $champ->Field);
                
                $metaform[$table] = $this->getItemImportant($table);
            }
        }
       
        return $metaform;
    }
    private function getMetaTable($nomTable=null){
       if($nomTable==null){$nomTable=$this->table->getNom();}
       return $this->requete('DESCRIBE  ' . $nomTable);
 }
    private function getItemImportant($nomTable=null) { // table item iportant
        $_meta = $this->getMetaTable($nomTable);
        $select = $this->getSelectColunneImportant($_meta);
        $item = $this->getTableSQL($select, $nomTable);
        return $item;
    }
    private function getSelectColunneImportant($_meta,$nomTable=null) { // string item important
        if($_meta==null){$_meta = $this->getMetaTable($nomTable); }
        $_select = '';
        
        foreach ($_meta as $key) {
            if ($key->Null == "NO" && $key->Type != "varchar(201)" && $key->Type != "varchar(20)") {
                $_select .= $key->Field . ' , ';
            }
        }
        $_select = rtrim($_select, ' , ');
        return $_select;
    }
    
    

    
    
}

