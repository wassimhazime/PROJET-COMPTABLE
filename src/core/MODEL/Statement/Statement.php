<?php

namespace core\model\Statement;

use core\model\Query\QuerySQL;
use core\model\entitys\entity;
use \PDO;
use \PDOException;
use core\model\base_donnee\database;
use core\notify\notify;

class Statement implements I_Statement {

    private $db;
    private $table;
    private $entity;
 
            function getTable() {
        return $this->table;
    }

    public function __construct($nom) {
        $this->db = database::getDB();
        $this->table = $nom;
        $this->entity = new entity();
    }


    
    public static function getshema() {
        $tables_main= (new self(''))->execute('SHOW TABLE STATUS WHERE name not LIKE("r\_%") ');
          $table_main=[];
          foreach ($tables_main as $table) {
           $table_main[$table->Name]=(new self($table->Name))->SHOW_COLUMNS_auto();
        }
       
        
         $tables_relation= (new self(''))->execute('SHOW TABLE STATUS WHERE name  LIKE("r\_%") ');
        $table_relation=[];
        foreach ($tables_relation as $table) {
            $table_relation[]=$table->Name;
        }
   
          
          
          foreach ($table_relation as $RD) {
          $merge=explode("_", ltrim($RD,"r_"));
          $table_main[$merge[0]][$merge[1]]=$table_main[$merge[1]];
          }
          return $table_main;
          
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
    public function Select($COLUMNS, $condition = 1) {


        return $this->execute((new QuerySQL())->select($COLUMNS)
                                ->from($this->table)
                                ->where($condition));
    }

    public function Select_Data_NotNull($COLUMNS = null) {
        if ($COLUMNS == null) {
            $COLUMNS = implode(' , ', $this->SHOW_COLUMNS_NotNull());
        }
        return $this->Select($COLUMNS);
    }

    public function show(array $show, $condition = " 1 ") {

        $Select = $show["select"];
        $TABLEpere = $show["pere"];
        $TABLEenfant = $show["enfant"];
        $TABLEalias = $show["alias"];
        $sqlpere = (new QuerySQL())->select($Select['pere'])
                ->from($TABLEpere)
                ->join($TABLEalias)
                ->where($condition)
        ;

        $sqlenfant = (new QuerySQL())->select($Select['enfant'])
                ->from($TABLEpere)
                ->join($TABLEenfant, "LEFT", true)
                ->where($condition)
        ;

        return ["pere" => $sqlpere, "enfant" => $sqlenfant];
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
        var_dump($sql . "");
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
