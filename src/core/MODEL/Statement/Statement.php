<?php

namespace core\model\Statement;

use core\model\Query\QuerySQL;
use core\model\entitys\entity;
use \PDO;
use \PDOException;
use core\model\base_donnee\database;
use core\notify\notify;
use core\model\entitys\EntitysSchema;

class Statement  {

    private $db;
    private $table;
    private $entity;
 
            function getTable() {
        return $this->table;
    }

    public function __construct($table) {
        $this->db = database::getDB();
        $this->table = $table;
        $this->entity = new entity();
    }


    
    
    
    ////////////////////////////////////////////////////////////////////////////
    
    
    
    public function update($data, $condition) {

        return (new QuerySQL())
                        ->update($this->table)
                        ->set($data)
                        ->where($condition);
    }

    public function delete($condition) {

        return (new QuerySQL())
                        ->delete($condition)
                        ->from($this->table);
    }

    public function insert($data) {

        unset($data['id']);

        return (new QuerySQL())->
                        insertInto($this->table)
                        ->value($data);
    }
////////////////////////////////////////////////////////////////////////////////
    public function Select(EntitysSchema $schema , $condition = 1) {


        return $this->execute((new QuerySQL())->select($schema->getCOLUMNS())
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
    public function execute($sql, $select = true) {

        try {
            if ($select) {
                $Statement = $this->db->query($sql);

                $Statement->setFetchMode(PDO::FETCH_CLASS, get_class($this->entity));


                return $Statement->fetchAll();
            } else {
                $this->db->exec($sql);
                return $this->db->lastInsertId();
            }
        } catch (PDOException $exc) {
            notify::send_Notify($exc->getMessage());
        }
    }
////////////////////////////////////////////////////////////////////////////////

    
    public function selectSchema() {

        return (new QuerySQL())->select("COLUMN_NAME")
                        ->from(" INFORMATION_SCHEMA.COLUMNS ")
                        ->where("TABLE_SCHEMA = 'comptable'", "TABLE_NAME = '" . $this->table . "'");
    }

    public function SHOW_COLUMNS() {

        ///  DESCRIBE === SHOW COLUMNS FROM
        return $this->execute("DESCRIBE  " . $this->table);
    }

    public function SHOW_COLUMNS_NotNull() {

        $describe = $this->execute("SHOW COLUMNS FROM " .
                $this->table .
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' ");

        $COLUMNS = [];
        foreach ($describe as $champ) {
            $COLUMNS[] = $champ->Field; //name COLUMNS 
        }
        return $COLUMNS;
    }
    public function SHOW_COLUMNS_auto() {

        $describe = $this->execute("SHOW COLUMNS FROM " .
                $this->table .
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' ");
        $select=[];

        foreach ($describe as $champ) {
            
            if ($champ->Key == 'MUL') { // FOREIGN KEY
                $champ->MUL = ($champ->Field);
              $select[]=[$champ->Field=>$champ->Field];
            } else {
             $select[]= $champ->Field;  
            }
        
                }
                return $select;
            }
            
            
}
