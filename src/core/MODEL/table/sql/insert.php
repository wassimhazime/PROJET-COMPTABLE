<?php
namespace core\model\table\sql;
class Insert{
    
    public $table;
    public $value;
  public static function syntaxeSQL($data,$table) {
       
        $id='id_'.$table;
        
        unset($data[$id]);

        $sql = "INSERT INTO $table";
        $sql .= " (`" . implode("`, `", array_keys($data)) . "`)";
        $sql .= " VALUES ('" . implode("', '", $data) . "') ";
        return $sql;
    }
    
    
    
    public function insertInto($table) {
        
            $this->table = $table;
        
        return $this;
    }

    public function value($data) {
        
        $this->value= " (`" . implode("`, `", array_keys($data)) . "`)".
        " VALUES ('" . implode("', '", $data) . "') ";
        return $this;
    }

    function query() {
        $insert = "INSERT INTO $this->table";
        $into = $this->value ;

        return $insert . $into ;
    }

    public function __toString() {
        return $this->query();
    }

    
    
}
