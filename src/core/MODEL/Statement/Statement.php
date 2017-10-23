<?php

namespace core\MODEL\Statement;

use core\MODEL\Base_Donnee\RUN;
use core\MODEL\Query\QuerySQL;
use core\MODEL\Entitys\EntitysDataTable;
use core\MODEL\Entitys\EntitysSchema;
use core\INTENT\Intent;
use core\MODEL\Outils\Schema;

class Statement extends RUN {

    

    function getTable() {
        return $this->schema->getPARENT();
    }

    public function __construct(EntitysSchema $schema) {
        parent::__construct(new EntitysDataTable(), $schema);
    }

    ////////////////////////////////////////////////////////////////////////////



    public function update($data, $condition) {

        return (new QuerySQL())
                        ->update($this->getTable())
                        ->set($data)
                        ->where($condition);
    }

    public function delete($condition) {



        return (new QuerySQL())
                        ->delete($condition)
                        ->from($this->getTable());
    }

    public function insert(Intent $intent) {
        $data=($intent->getEntitysDataTable());
       unset($data[0]->id);
       $insert=[];
        foreach ($data[0] as $key => $value) {
          $insert[$key]=  $value;
        }
       
        $querySQL = (new QuerySQL())->
                        insertInto($this->getTable())
                        ->value($insert);
        $this->exec($querySQL);
    }

////////////////////////////////////////////////////////////////////////////////
    public function Select(array $mode = Intent::MODE_SELECT_ALL_ALL, $condition = 1): Intent {
        $schema = $this->schema;
        if ( Intent::is_PARENT_MASTER($mode) ) {
            $Entitys = $this->query((new QuerySQL())
                            ->select($schema->select_master())
                            ->from($schema->getPARENT())
                            ->join($schema->getFOREIGN_KEY())
                            ->where($condition));
        } elseif (Intent::is_PARENT_ALL($mode)) {
            $Entitys = $this->query((new QuerySQL())
                            ->select($schema->select_all())
                            ->from($schema->getPARENT())
                            ->join($schema->getFOREIGN_KEY())
                            ->where($condition));
        }
        $this->setDataJoins($Entitys, $mode);
        
        return new Intent($schema, $Entitys, $mode);
    }

    private function setDataJoins(array $Entitys,array $mode) {
        $schema = $this->schema;

        foreach ($Entitys as $Entity) {
            if (!empty($schema->get_table_CHILDREN())and Intent::is_get_CHILDREN($mode)) {
                foreach ($schema->get_table_CHILDREN() as $tablechild) {
                    $Entity->setDataJOIN($tablechild, $this->query((
                                            new QuerySQL())
                                            ->select($schema->select_CHILDREN($tablechild,$mode[1]))
                                            ->from($schema->getPARENT())
                                            ->join($tablechild, " INNER ", TRUE)
                                            ->where($schema->getPARENT() . ".id = " . $Entity->id)));
                }
            } else {

                $Entity->setDataJOIN("empty", []);
            }
        }
    }

//    public function independent($Select, $TABLEenfant) {
//
//        return (new QuerySQL())->select($Select)
//                        ->from($TABLEenfant)
//                        ->join("raison_sociale")
//                        ->independent($TABLEpere);
//    }

////////////////////////////////////////////////////////////////////////////////
    public function form(array $mode = Intent::MODE_FORM): Intent {
        $schema = $this->schema;
        $nameTable_FOREIGNs= $schema->getFOREIGN_KEY();
        
        $Entitys_FOREIGNs=[];
       foreach ($nameTable_FOREIGNs as $nameTable_FOREIGN) {
           
           $schem_Table_FOREIGN=Schema::getschema($nameTable_FOREIGN);
           
           $Entitys_FOREIGNs[$nameTable_FOREIGN] = 
                   
                   
                   $this->query((new QuerySQL()) 
                            ->select($schem_Table_FOREIGN->select_master())
                            ->from($schem_Table_FOREIGN->getPARENT())
                            ->join($schem_Table_FOREIGN->getFOREIGN_KEY())
                           
                           
                        );
           }
           
           
           ////////////////////////////////////////////////////////////
           $nameTable_CHILDRENs= $schema->get_table_CHILDREN();
           $Entitys_CHILDRENs=[];
           
           foreach ($nameTable_CHILDRENs as $table_CHILDREN) {
               
               
           $schem_Table_CHILDREN=Schema::getschema($table_CHILDREN);               
          
               $Entitys_CHILDRENs[$table_CHILDREN]= 
                       $this->query(((new QuerySQL())
                        ->select($schem_Table_CHILDREN->select_master())
                        ->from($schem_Table_CHILDREN->getPARENT())
                        ->join($schem_Table_CHILDREN->getFOREIGN_KEY())
                        ->independent($schema->getPARENT())));
           }
           
           $data=["FOREIGN_KEYs"=>$Entitys_FOREIGNs,
                   "CHILDRENs"=>$Entitys_CHILDRENs];
           
       return new Intent($schema, $data, $mode);
    }
    
    
}
