<?php

namespace core\model\Statement;
use core\model\base_donnee\RUN;

use core\model\Query\QuerySQL;
use core\model\Entitys\EntitysTable;

use core\model\Entitys\EntitysSchema;

class Statement extends RUN {

   
 
            function getTable() {
        return $this->schema->getPARENT();
    }

    public function __construct(EntitysSchema $schema) {
        parent::__construct(new EntitysTable(),$schema);
      
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
    public function Select(EntitysSchema $schema=null , $condition = 1) {
if($schema==null){$schema= $this->schema;}

        return $this->run((new QuerySQL())->select($schema->getCOLUMNS_master())
                             //    ->join($schema->getFOREIGN_KEY())
                                ->from($schema->getPARENT())
                                ->where($condition));
    }

    public function Select_Data_NotNull($COLUMNS = null) {
        if ($COLUMNS == null) {
            $COLUMNS = implode(' , ', $this->SHOW_COLUMNS_NotNull());
        }
        return $this->Select($COLUMNS);
    }

   

    public function join($Select, $TABLEpere, $TABLEenfant, $condition) {
        $selectarry = explode(",", $Select);
        $sele = [];
        foreach ($selectarry as $sele) {
            $s[] = "$TABLEenfant.$sele";
        }

        $sql = (new QuerySQL())->select(implode(",", $s), "raison_sociale.raison_sociale")
                ->from($TABLEpere)
                ->join($TABLEenfant, "LEFT", true)
                ->join("raison_sociale")
                ->where($condition)
        ;
    
        return $sql;
    }

    public function independent($Select, $TABLEenfant) {

        return (new QuerySQL())->select($Select)
                        ->from($TABLEenfant)
                        ->join("raison_sociale")
                        ->independent($TABLEpere);
    }
////////////////////////////////////////////////////////////////////////////////

  
            
            
}
