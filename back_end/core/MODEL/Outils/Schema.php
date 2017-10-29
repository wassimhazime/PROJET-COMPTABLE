<?php

namespace core\MODEL\Outils;

use core\MODEL\Entitys\EntitysSchema;
use core\MODEL\Base_Donnee\RUN;
use core\MODEL\Base_Donnee\Config;

class Schema extends RUN {

    private static $PARENT = null;

    function __construct() {
        parent::__construct(new EntitysSchema());
    }



    
    public static function getschema(string $parent): EntitysSchema {
        if(Config::getgenerateCACHE_SELECT()==['generateCACHE_SELECT']){
            self::generateCache(Config::getPath());}
        
            
            //find json config => model file 1generateCACHE_SELECT
        foreach (Config::getgenerateCACHE_SELECT() as $table) {
            $TABLE = (new EntitysSchema())->Instance($table);
            if ($TABLE->getPARENT() == $parent) {
                return $TABLE;
            }
        }
            //find json config => model file 2SCHEMA_SELECT_MANUAL
        foreach (Config::getSCHEMA_SELECT_MANUAL() as $table) {
              
            $TABLE = (new EntitysSchema())->Instance($table);
            if ($TABLE->getPARENT() == $parent) {
                return $TABLE;
            }
        }
            //find json config => model file 3SCHEMA_SELECT_AUTO 
            //and system SCHEMA_SELECT_AUTO
        foreach (self::getALLschema( Config::getNameDataBase(),Config::getSCHEMA_SELECT_AUTO()) as $TABLE) {
            if ($TABLE->getPARENT() == $parent) {

                return $TABLE;
            }
        }
        
        
        return (new EntitysSchema()); // == return EntitysSchema vide
    }

    public static function getALLschema( string $DB_name=null,array $config = []): array {
        if (self::$PARENT == null) {
            
            if($DB_name==null){$DB_name=Config::getNameDataBase();}
            
            $PARENT = (new self())->query(' SELECT table_name as PARENT FROM INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_SCHEMA = "' . $DB_name . '" and  table_name not LIKE("r\_%") ');
            foreach ($PARENT as $table) {
                $table->setCOLUMNS_master((new self())->columns_master($table, $config));
                $table->setCOLUMNS_all((new self())->columns_all($table, $config));
                $table->setCOLUMNS_META((new self())->columns_META($table, $config));
                $table->setFOREIGN_KEY((new self())->FOREIGN_KEY($table, $config));
                $table->setCHILDREN((new self())->tables_CHILDREN($table, $config, $DB_name));
            }
            self::$PARENT = $PARENT;

            return $PARENT;
        } else {
            return self::$PARENT;
        }
    }

    private function columns_master($table, array $config = []) {
        if (isset($config['COLUMNS_master']) and ! empty($config['COLUMNS_master'])) {
            $describe = $this->query("SHOW COLUMNS FROM " .
                    $table->getPARENT() .
                    $config['COLUMNS_master']
            );
        } else {
            $describe = $this->query("SHOW COLUMNS FROM " .
                    $table->getPARENT() .
                    " WHERE `null`='no' and "
                    . "`Type` !='varchar(201)' and"
                    . " `Type` !='varchar(20)' and "
                    . "`Key`!='MUL' "
            );
        }


        $select = [];

        foreach ($describe as $champ) {


            $select[] = $champ->Field;
        }
        return $select;
    }

    private function columns_all($table, array $config = []) {
        if (isset($config['COLUMNS_all']) and ! empty($config['COLUMNS_all'])) {
            $describe = $this->query("SHOW COLUMNS FROM " .
                    $table->getPARENT() .
                    $config['COLUMNS_all']
            );
        } else {
            $describe = $this->query("SHOW COLUMNS FROM " .
                    $table->getPARENT() .
                    " WHERE "
                    . "`Key`!='MUL' "
            );
        }


        $select = [];

        foreach ($describe as $champ) {


            $select[] = $champ->Field;
        }
        return $select;
    }
    
    private function columns_META($table, array $config = []) {
        
        if (isset($config['COLUMNS_META']) and ! empty($config['COLUMNS_META'])) {
            $describe = $this->query("  DESCRIBE   " .
                    $table->getPARENT() 
            );
        } else {
            $describe = $this->query("DESCRIBE " .
                    $table->getPARENT() 
            );
        }


       
        return $describe;
    }
    

    private function columns_master_CHILDREN($table, array $config = []) {

        if (isset($config['CHILDREN']['MASTER']) and ! empty($config['CHILDREN']['MASTER'])) {
            $describe = $this->query("SHOW COLUMNS FROM " . $table .
                    $config['CHILDREN']['MASTER']
            );
        } else {
            $describe = $this->query("SHOW COLUMNS FROM " . $table .
                    " WHERE `null`='no' and "
                    . "`Type` !='varchar(201)' and"
                    . " `Type` !='varchar(20)' and"
                    . "`Key`!='MUL' ");
        }


        $colums = [];
        if (!empty($describe) or $describe != null) {
            foreach ($describe as $colum) {

                $colums[] = $colum->Field;
            }
        }

        return $colums;
    }

    private function columns_all_CHILDREN($table, array $config = []) {
        if (isset($config['CHILDREN']['ALL']) and ! empty($config['CHILDREN']['ALL'])) {
            $describe = $this->query("SHOW COLUMNS FROM " . $table .
                    $config['CHILDREN']['ALL']
            );
        } else {
            $describe = $this->query("SHOW COLUMNS FROM " . $table .
                    " WHERE "
                    . "`Key`!='MUL' ");
        }


        $colums = [];
        if (!empty($describe) or $describe != null) {
            foreach ($describe as $colum) {

                $colums[] = $colum->Field;
            }
        }

        return $colums;
    }

    private function FOREIGN_KEY($table, array $config = []) {
        if (isset($config['FOREIGN_KEY']) and ! empty($config['FOREIGN_KEY'])) {
            $describe = $this->query("SHOW COLUMNS FROM " .
                    $table->getPARENT() .
                    $config['FOREIGN_KEY']
            );
        } else {
            $describe = $this->query("SHOW COLUMNS FROM " .
                    $table->getPARENT() .
                    " WHERE `Key`='MUL'"
            );
        }


        $FOREIGN_KEY = [];

        foreach ($describe as $champ) {
            $FOREIGN_KEY[] = $champ->Field;
        }
        return $FOREIGN_KEY;
    }

    private function tables_CHILDREN($mainTable, $config, $DB_name) {
        $tables_relation = (new self(''))->query('SELECT table_name as tables_relation FROM'
                . ' INFORMATION_SCHEMA.PARTITIONS WHERE TABLE_SCHEMA = "' . $DB_name . '" '
                . 'and  table_name  LIKE("r\_' . $mainTable->getPARENT() . '%")  ');
        $tables_CHILDREN['MASTER'] = [];
        $tables_CHILDREN['ALL'] = [];
        $tables_CHILDREN['EMPTY'] = [];

        foreach ($tables_relation as $champ) {
            $table = str_replace("r_{$mainTable->getPARENT()}_", "", $champ->tables_relation);

            $tables_CHILDREN['MASTER'][$table] = (new self())->columns_master_CHILDREN($table, $config);
            $tables_CHILDREN['ALL'][$table] = (new self())->columns_all_CHILDREN($table, $config);
            $tables_CHILDREN['EMPTY'][$table] = [];
        }
        return $tables_CHILDREN;
    }
    
    

   ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * generateCache
     */
    
    
    //////////////////////////////////////
    private static function generateCache(string $path){
    $tempschmaTabls=[];
    $schmaTabls=[];
    $DB_AUTO = self::getALLschema( Config::getNameDataBase(),Config::getSCHEMA_SELECT_AUTO());
        foreach ($DB_AUTO as $TABLE) {
            $tempschmaTabls[$TABLE->getPARENT()]=$TABLE;
      }
    
    foreach (Config::getSCHEMA_SELECT_MANUAL() as $table) {
        $TABLE = (new EntitysSchema())->Instance($table);
            $tempschmaTabls[$TABLE->getPARENT()]= self::parse_object_TO_array($TABLE);
        }
        foreach ($tempschmaTabls as $PARENT => $TABLE) {
          $schmaTabls[]=self::parse_object_TO_array($TABLE);  
        }
        self::json_fileOUT($schmaTabls,$path."1generateCACHE_SELECT.json");
        
    
}
   


}
