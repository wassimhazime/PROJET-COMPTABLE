<?php
namespace core\model\table\sql;
class Delete{
    
    public static function syntaxeSQL($data,$table) {
       
        $sql = 'delete from  '
                . $table
                . '  where id = '
                . $data['id'];
        return $sql;
    }
    
    
      
    private $from = [];
    private $conditions = ["0"];

    function __construct() {
        
    }

    

    public function from($table) {
        
            $this->from[] = $table;
        
        return $this;
    }

    public function delete() {
        if ($this->conditions == ["0"]) {
            $this->conditions = [];
        }
        foreach (func_get_args() as $arg) {
            $this->conditions[] = $arg;
        }

        return $this;
    }

    function query() {
        $delete = 'DELETE ' ;
        $from = ' FROM ' . implode(', ', $this->from);

        $where = ' WHERE ' . implode(' AND ', $this->conditions);
        return $delete . $from . $where;
    }

    public function __toString() {
        return $this->query();
    }
    
}
