<?php
namespace core\model\table\sql;
class insert{
    
  public static function syntaxeSQL($data,$table) {
       
        $id='id_'.$table;
        
        unset($data[$id]);

        $sql = "INSERT INTO $table";
        $sql .= " (`" . implode("`, `", array_keys($data)) . "`)";
        $sql .= " VALUES ('" . implode("', '", $data) . "') ";
        return $sql;
    }
    
    
}
