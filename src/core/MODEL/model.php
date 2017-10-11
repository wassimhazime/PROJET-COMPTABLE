<?php
namespace core\model;
use core\model\base_donnee\database;
use core\model\entitys\entity;
use core\model\Statement\Statement;
use \PDO;
use \PDOException;


use core\notify\notify;

class model {
    private $db;
    public $table;
    public $entity;
    

            
    public function __construct( $table, $db = null) {

        
        $this->statement = new Statement($table);
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
    
    public function getNameTable() {
        return $this->requete("SHOW TABLES WHERE Tables_in_comptable not  LIKE 'r\_%'");
    }
    
    public function setData($data,$relation=null) {
        unset($data['ajout_data']);

        $dataRelation = null;
       
        if ($relation != null) {
            if (is_array($relation)) {
                foreach ($relation as $RD) {
                    if (isset($data[$RD])) {
                        $nomTableRelation[$RD] = 'r_' . $this->statement->getNom() . '_' . $RD;
                        $dataRelation[$RD] = $data[$RD];
                        $RL[]=$RD;
                        unset($data[$RD]);
                    }
                }
            } else {
                $nomTableRelation = 'r_' . $this->statement->getNom() . '_' . $relation; //exemple d_facture_bl
                $dataRelation = $data[$relation];
                unset($data[$relation]);
            }
        }
        $id = 'id' ;

        if ($data[$id] == '') {
           
            $idPere = $this->requete($this->statement->insert($data), false);
            
            if ($dataRelation != null) {
                if (is_array($RL)) {
                    
                    foreach ($RL as $RD) {
                        
                        foreach ($dataRelation[$RD] as $enfant) {
                            $item=null;
                            $item[$id . '_detail'] = $idPere;
                            $item['id_' . $RD . '_detail'] = $enfant;
                            
                            $this->requete($this->statement->insert($item, $nomTableRelation[$RD]), false);
                        }
                    }
                } else {
                    foreach ($dataRelation as $enfant) {
                        $item[$id . '_detail'] = $idPere;
                        $item['id_' . $relation . '_detail'] = $enfant;
                        $this->requete($this->statement->insert($item, $nomTableRelation), false);
                    }
                }
            }
        } else {
            
             $this->requete($this->statement->update($data), false);
        }

       
    }

    public function getData($condition,$link,$select) { // error
        
       
     if ($condition[0] == "" or $condition == ""  )
         {return null;}
    $sql= $this->statement->select($select, $condition);
    
         return $this->requete($sql);
           
    }
   
    
    public function show(array $show) {
        $TABLEpere=$this->statement->getNom();
        $TABLEenfant=[];
        $TABLEalias=[];
        $select['enfant'] = [];
        $select['pere'] = [];
        
        foreach ($show as $value) {

            if (is_array($value)) {

                foreach ($value as $key => $val) {
                    if (is_array($val)) {
                        foreach ($val as $v) {
                            $select['enfant'][] = $key . "." . $v;
                            $TABLEenfant[$key]=$key;
                        }
                    } else {
                        $select['pere'][] = $key . "." . $val;
                        $TABLEalias[$key]=$key;
                    }
                }
            } else {
                $select['pere'][] =$TABLEpere  . "." . $value;
            }
        }
        
        $SHOW=['select'=>$select,'pere'=>$TABLEpere,'enfant'=>$TABLEenfant,'alias'=>$TABLEalias ];
          $sql=$this->statement->show($SHOW);
          $data = $this->requete($sql["pere"]);
          
          foreach ($data as $v) {
              $id=$v->id;
              $sql=$this->statement->show($SHOW,"avoir.id=$id");
              $dataEnfant = $this->requete($sql["enfant"]);
              $v->setEnfant("ok",$dataEnfant);
          }
          var_dump($data);
          die();
    }

    
    
    
    public function getTableSQLrelation( $tableEnfant,$selectEnfant,$selectPere = null) {
         $TABLEpere=$this->statement->getNom();
         $datapere= $this->getTableSQL($selectPere,$TABLEpere);
         $idpere='id';

        foreach ($datapere as $row) {
            for ($index = 0; $index < count($tableEnfant); $index++) {
            $sql = $this->statement->join($selectEnfant[$index],
                    $TABLEpere,
                    $tableEnfant[$index]
                    ,"$TABLEpere.$idpere  =  {$row->$idpere}");
            
            $row->setEnfant($tableEnfant[$index],$this->requete($sql));  
            }
        }
        
        return $datapere;
    }
    
    public function getTableSQL($colunne = null, $table = null,$condition=null) {
        if ($colunne == null) {$colunne = $this->getSelectColunneImportant(null,$table);}
        $sql = $this->statement->select($colunne, $condition, $table);
        $data = $this->requete($sql);

        //si les champs de la table et vide  
        if ($data == null) {
            $sql = $this->statement->selectSchema($table);
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
      $sql = $this->statement->independent($colunne, $TABLEpere, $TABLEenfant);
        $data = $this->requete($sql);
          //si les champs de la table et vide  
        if ($data == null) {
            $sql = $this->statement->selectSchema($TABLEenfant);
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
                
                $table = $champ->Field;
             $metaform[$table] = $this->getItemImportant($table);
            }
        }
       
        return $metaform;
    }
    private function getMetaTable($nomTable=null){
       if($nomTable==null){
           $nomTable=$this->statement->getTable();}
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

