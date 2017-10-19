<?php

namespace core\INTENT;

use core\MODEL\Entitys\EntitysSchema;
use core\MODEL\Entitys\EntitysTable;

class Intent {
    const MODE_SELECT_MASTER_MASTER =  ["MASTER","MASTER"];
    const MODE_SELECT_MASTER_ALL =     ["MASTER","ALL"   ];
    const MODE_SELECT_ALL_MASTER =     ["ALL"   ,"MASTER"];
    const MODE_SELECT_ALL_ALL =        ["ALL"   ,"ALL"   ];
    const MODE_SELECT_MASTER_NULL =    ["MASTER","EMPTY"   ];
    const MODE_SELECT_ALL_NULL =       ["ALL"   ,"EMPTY"];
    
    
    
    public static function is_PARENT_MASTER( $_intentORmode):bool{
        if($_intentORmode instanceof Intent){
        $mode=$_intentORmode->getMode();
        }else{$mode=$_intentORmode;}
        
        return $mode[0]=="MASTER";
    }
    public static function is_PARENT_ALL($_intentORmode):bool{
         if($_intentORmode instanceof Intent){
        $mode=$_intentORmode->getMode();
        }else{$mode=$_intentORmode;}
        return $mode[0]=="ALL";
    }
     public static function is_get_CHILDREN($_intentORmode):bool{
         if($_intentORmode instanceof Intent){
        $mode=$_intentORmode->getMode();
        }else{$mode=$_intentORmode;}
        return $mode[1]!="EMPTY";
    }

    
    private $entitysSchema;
    private $entitysTable;
    private $mode;

    public function getEntitysSchema(): EntitysSchema {
        return $this->entitysSchema;
    }

    public function getEntitysTable(): array {
        return $this->entitysTable;
    }

    public function getMode(): array {
        return $this->mode;
    }

    public static function parse(array $data, EntitysSchema $schema, array $mode = self::MODE_SELECT_MASTER_MASTER):self {
        if (self::isAssoc($data) and isset($data)) {
            return (new self($schema, ((new EntitysTable())->set($data)), $mode));
        }
    }

    public function __construct(EntitysSchema $entitysSchema, array $entitysTables, array $mode) {



        foreach ($entitysTables as $entitysTable) {
            if ($entitysTable instanceof EntitysTable) {
                
            } else {

                throw new \TypeError("type array entre ERROR ==> entitysTables");
            }
        }
        $this->mode = $mode;

        $this->entitysSchema = $entitysSchema;
        $this->entitysTable = $entitysTables;
    }

    public static function isAssoc(array $arr): bool {
        if (array() === $arr)
            return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}
