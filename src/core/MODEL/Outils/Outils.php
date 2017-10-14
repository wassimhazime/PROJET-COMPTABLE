<?php

namespace core\MODEL\Outils;

use core\model\entitys\EntitysSchema;
use \PDO;
use \PDOException;
use core\model\base_donnee\database;
use core\notify\notify;

class Outils {

    private $db, $EntitysShema;

    function __construct() {
        $this->db = database::getDB();
        $this->EntitysShema = new EntitysSchema();
    }

    public static function getschema($parent = null) :EntitysSchema {
        $PARENT = (new self(''))->run(' SELECT table_name as PARENT FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_SCHEMA = "comptable" and  table_name not LIKE("r\_%") ');

       
        foreach ($PARENT as $table) {


            $table->setCOLUMNS((new self())->columns_master($table));

            $table->setFOREIGN_KEY((new self())->FOREIGN_KEY($table));

            $table->setCHILDREN((new self())->tables_CHILDREN($table));
           
        }

        //// fin
       
        if ($parent == null) {
            return $PARENT;
        } else {
            foreach ($PARENT as $TABLE) {
                if ($TABLE->PARENT == $parent) {
                    return $TABLE;
                }
            }
        }
    }

    public function run($sql, $select = true) {

        try {
            if ($select) {
                $Statement = $this->db->query($sql);


                $Statement->setFetchMode(PDO::FETCH_CLASS, get_class($this->EntitysShema));


                return $Statement->fetchAll();
            } else {
                $this->db->exec($sql);
                return $this->db->lastInsertId();
            }
        } catch (PDOException $exc) {
            notify::send_Notify($exc->getMessage()."   ".$sql);
        }
    }

    public function columns_master($table) {

        $describe = $this->run("SHOW COLUMNS FROM " .
                $table->PARENT .
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' ");
        $select = [];

        foreach ($describe as $champ) {


            $select[] = $champ->Field;
        }
        return $select;
    }

    public function columns_master_CHILDREN($table) {

        $describe = $this->run("SHOW COLUMNS FROM " . $table .
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' and"
                . "`Key`!='MUL' ");
        $colums = [];
        if (!empty($describe) or $describe != null) {
            foreach ($describe as $colum) {

                $colums[] = $colum->Field;
            }
        }

        return $colums;
    }

    public function FOREIGN_KEY($table) {

        $describe = $this->run("SHOW COLUMNS FROM " .
                $table->PARENT .
                " WHERE `Key`='MUL'");
        $FOREIGN_KEY = [];

        foreach ($describe as $champ) {
            $FOREIGN_KEY[] = $champ->Field;
        }
        return $FOREIGN_KEY;
    }

    public function tables_CHILDREN($mainTable) {
        $tables_relation = (new self(''))->run('SELECT table_name as tables_relation FROM'
                . ' INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_SCHEMA = "comptable" '
                . 'and  table_name  LIKE("r\_' . $mainTable->PARENT . '%")  ');
        $tables_CHILDREN = [];

        foreach ($tables_relation as $champ) {
            $table=str_replace("r_{$mainTable->PARENT}_",
                    "",
                    $champ->tables_relation );
            
            $tables_CHILDREN[$table] = (new self())->columns_master_CHILDREN($table);
        }
        return $tables_CHILDREN;
    }

}
