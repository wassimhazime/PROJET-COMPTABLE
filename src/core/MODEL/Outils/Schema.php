<?php

namespace core\MODEL\Outils;

use core\MODEL\entitys\EntitysSchema;
use core\MODEL\base_donnee\RUN;

class Schema extends RUN {

    

    function __construct() {
        parent::__construct(new EntitysSchema());
        
    }

    public static function getschema($parent = null) :EntitysSchema {
        $PARENT = (new self(''))->run(' SELECT table_name as PARENT FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_SCHEMA = "comptable" and  table_name not LIKE("r\_%") ');

       
        foreach ($PARENT as $table) {


             $table->setCOLUMNS_master((new self())->columns_master($table));
             $table->setCOLUMNS_all((new self())->columns_all($table));
             $table->setFOREIGN_KEY((new self())->FOREIGN_KEY($table));
             $table->setCHILDREN((new self())->tables_CHILDREN($table));
           
        }

        //// fin
       
        if ($parent == null) {
            return $PARENT;
        } else {
            foreach ($PARENT as $TABLE) {
                if ($TABLE->getPARENT() == $parent) {
                    return $TABLE;
                }
            }
        }
    }
    
    
    
    

    

private function columns_master($table) {

        $describe = $this->run("SHOW COLUMNS FROM " .
                $table->getPARENT() .
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' and "
                . "`Key`!='MUL' "
                );
        $select = [];

        foreach ($describe as $champ) {


            $select[] = $champ->Field;
        }
        return $select;
    }
private function columns_all($table) {

        $describe = $this->run("SHOW COLUMNS FROM " .
                $table->getPARENT() .
                " WHERE "
                . "`Key`!='MUL' "
                );
        $select = [];

        foreach ($describe as $champ) {


            $select[] = $champ->Field;
        }
        return $select;
    }
private function columns_master_CHILDREN($table) {

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
private function FOREIGN_KEY($table) {

        $describe = $this->run("SHOW COLUMNS FROM " .
                $table->getPARENT() .
                " WHERE `Key`='MUL'");
        $FOREIGN_KEY = [];

        foreach ($describe as $champ) {
            $FOREIGN_KEY[] = $champ->Field;
        }
        return $FOREIGN_KEY;
    }
private function tables_CHILDREN($mainTable) {
        $tables_relation = (new self(''))->run('SELECT table_name as tables_relation FROM'
                . ' INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_SCHEMA = "comptable" '
                . 'and  table_name  LIKE("r\_' . $mainTable->getPARENT() . '%")  ');
        $tables_CHILDREN = [];

        foreach ($tables_relation as $champ) {
            $table=str_replace("r_{$mainTable->getPARENT()}_",
                    "",
                    $champ->tables_relation );
            
            $tables_CHILDREN[$table] = (new self())->columns_master_CHILDREN($table);
        }
        return $tables_CHILDREN;
    }

}
