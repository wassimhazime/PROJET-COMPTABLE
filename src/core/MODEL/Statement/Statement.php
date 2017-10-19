<?php

namespace core\MODEL\Statement;

use core\MODEL\Base_Donnee\RUN;
use core\MODEL\Query\QuerySQL;
use core\MODEL\Entitys\EntitysTable;
use core\MODEL\Entitys\EntitysSchema;
use core\INTENT\Intent;

class Statement extends RUN {

    

    function getTable() {
        return $this->schema->getPARENT();
    }

    public function __construct(EntitysSchema $schema) {
        parent::__construct(new EntitysTable(), $schema);
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
        $data=($intent->getEntitysTable()[0]);
       $insert=[];
        foreach ($data as $key => $value) {
          $insert[$key]=  $value;
        }

        unset($insert['id']);
        
        
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

    public function independent($Select, $TABLEenfant) {

        return (new QuerySQL())->select($Select)
                        ->from($TABLEenfant)
                        ->join("raison_sociale")
                        ->independent($TABLEpere);
    }

////////////////////////////////////////////////////////////////////////////////
}
