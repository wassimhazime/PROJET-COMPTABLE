<?php
namespace core\model\table\sql;
class select{
    
    public static function syntaxeSQL($colunne,$condition,$table) {
      
        if ($condition!=null  ) {
        $sql = "select $colunne from $table where ";
        $sql .= " `" . implode("`, `", array_keys($condition)) . "`";
        $sql .= " = '" . implode("', '", $condition) . "' ";
        } else {
            $sql='select ' . $colunne . ' from ' . $table;
        }
        return $sql;
    }
    
   public static function syntaxeSchemaSQL($table) {
       $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'comptable' AND TABLE_NAME = '$table'";
        return $sql;
    } 
    
    
}

