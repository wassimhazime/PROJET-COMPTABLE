<?php
namespace core\model;

use core\model\entitys\entity;
use core\model\Statement\Statement;


class model {

   
    public $entity;
    private $statement;



    public function __construct( $table) {

        
        $this->statement = new Statement($table);
        
    
        
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
           
            $idPere = $this->execute($this->statement->insert($data), false);
            
            if ($dataRelation != null) {
                if (is_array($RL)) {
                    
                    foreach ($RL as $RD) {
                        
                        foreach ($dataRelation[$RD] as $enfant) {
                            $item=null;
                            $item[$id . '_detail'] = $idPere;
                            $item['id_' . $RD . '_detail'] = $enfant;
                            
                            $this->execute($this->statement->insert($item, $nomTableRelation[$RD]), false);
                        }
                    }
                } else {
                    foreach ($dataRelation as $enfant) {
                        $item[$id . '_detail'] = $idPere;
                        $item['id_' . $relation . '_detail'] = $enfant;
                        $this->execute($this->statement->insert($item, $nomTableRelation), false);
                    }
                }
            }
        } else {
            
             $this->execute($this->statement->update($data), false);
        }

       
    }

    public function getData($condition,$link,$select) { // error
        
       
     if ($condition[0] == "" or $condition == ""  )
         {return null;}

    
         return $this->statement->select($select, $condition);
           
    }
   
    
    public function show(array $show,$condition=null) {

        $TABLEpere=$this->statement->getTable();
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
          var_dump($sql );
        die();
          $data = $this->statement->execute($sql["pere"]);
          
          foreach ($data as $v) {
              $id=$v->id;
              $sql=$this->statement->show($SHOW,"avoir.id=$id");
              $dataEnfant = $this->statement->execute($sql["enfant"]);
              $v->setEnfant("ok",$dataEnfant);
          }
          
          
          
          
             }

    
    
    
    public function getTableSQLrelation( $tableEnfant,$selectEnfant,$selectPere = null) {
         $TABLEpere=$this->statement->getTable();
         $datapere= $this->getTableSQL($selectPere,$TABLEpere);
         $idpere='id';

        foreach ($datapere as $row) {
            for ($index = 0; $index < count($tableEnfant); $index++) {
            $sql = $this->statement->join($selectEnfant[$index],
                    $TABLEpere,
                    $tableEnfant[$index]
                    ,"$TABLEpere.$idpere  =  {$row->$idpere}");
            
            $row->setEnfant($tableEnfant[$index],$this->statement->execute($sql));  
            }
        }
        
        return $datapere;
    }
    
    public function getTableSQL($colunne = null, $table = null,$condition=null) {
        //if ($colunne == null) {$colunne = $this->getSelectColunneImportant(null,$table);}
        
        
          
        $data = $this->statement->Select_Data_NotNull();
        //si les champs de la table et vide  
        if ($data == null) {
           
            $data = $this->statement->selectSchema($table);
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
        $data = $this->execute($sql);
          //si les champs de la table et vide  
        if ($data == null) {
            $sql = $this->statement->selectSchema($TABLEenfant);
            $data = $this->execute($sql);
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
        $metaform = [];
        $metaform = $this->statement->SHOW_COLUMNS();

        foreach ($metaform as $champ) {
            if ($champ->Key == 'MUL') { // FOREIGN KEY
               $champ->Data = (
                       new Statement($champ->Field))
                       ->Select_Data_NotNull();
              
            }
            
        }
       
        return $metaform;
    }
   

    
    
 

    
    
}

