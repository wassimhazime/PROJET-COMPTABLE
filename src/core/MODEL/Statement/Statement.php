<?php

namespace core\MODEL\Statement;

use core\MODEL\Base_Donnee\RUN;
use core\MODEL\Query\QuerySQL;
use core\MODEL\Entitys\EntitysTable;
use core\MODEL\Entitys\EntitysSchema;

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
    public function Select(EntitysSchema $schema = null, $condition = 1): array {
        if ($schema == null) {
            $schema = $this->schema;
        }
        $Entitys = $this->run((new QuerySQL())
                        ->select($schema->select_master())
                        ->from($schema->getPARENT())
                        ->join($schema->getFOREIGN_KEY())
                        ->where($condition));
        return $this->dataJoin($Entitys, $schema);
    }

    private function dataJoin(array $Entitys,EntitysSchema $schema): array {

        foreach ($Entitys as $Entity) {
            if (!empty($schema->get_table_CHILDREN())) {
                foreach ($schema->get_table_CHILDREN() as $tablechild) {
                    $Entity->setDataJOIN($tablechild, $this->run((
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
        return $Entitys;
    }

    public function independent($Select, $TABLEenfant) {

        return (new QuerySQL())->select($Select)
                        ->from($TABLEenfant)
                        ->join("raison_sociale")
                        ->independent($TABLEpere);
    }

////////////////////////////////////////////////////////////////////////////////
}
