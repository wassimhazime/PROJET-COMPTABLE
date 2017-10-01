<?php

// facde
namespace core\model\table\sql;

use core\model\table\sql\Insert;
use core\model\table\sql\update;
use core\model\table\sql\Delete;
use core\model\table\sql\Select;
use core\model\table\sql\join;

class SQL {
   public static function __callStatic($name, $arguments){
       if($name=="select"){
        $query = new Select(); 
        return call_user_func_array([$query, $name], $arguments);
       }
       if($name=="insertInto"){
        $query = new Insert(); 
        return call_user_func_array([$query, $name], $arguments);
       }
       if($name=="delete"){
        $query = new Delete(); 
        return call_user_func_array([$query, $name], $arguments);
       }
    }
}
