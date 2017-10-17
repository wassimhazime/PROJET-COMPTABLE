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

    public function insert($data) {

        unset($data['id']);

        return (new QuerySQL())->
                        insertInto($this->getTable())
                        ->value($data);
    }

////////////////////////////////////////////////////////////////////////////////
    public function Select(int $mode = Intent::MODE_SELECT_MASTER, $condition = 1): Intent {
        $schema = $this->schema;
        if ($mode == Intent::MODE_SELECT_MASTER) {
            $Entitys = $this->query((new QuerySQL())
                            ->select($schema->select_master())
                            ->from($schema->getPARENT())
                            ->join($schema->getFOREIGN_KEY())
                            ->where($condition));
        } elseif ($mode == Intent::MODE_SELECT_ALL) {
            $Entitys = $this->query((new QuerySQL())
                            ->select($schema->select_all())
                            ->from($schema->getPARENT())
                            ->join($schema->getFOREIGN_KEY())
                            ->where($condition));
        }
        $this->setDataJoins($Entitys);
        
        return new Intent($schema, $Entitys, $mode);
    }

    private function setDataJoins(array $Entitys) {
        $schema = $this->schema;

        foreach ($Entitys as $Entity) {
            if (!empty($schema->get_table_CHILDREN())) {
                foreach ($schema->get_table_CHILDREN() as $tablechild) {
                    $Entity->setDataJOIN($tablechild, $this->query((
                                            new QuerySQL())
                                            ->select($schema->select_CHILDREN($tablechild))
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
