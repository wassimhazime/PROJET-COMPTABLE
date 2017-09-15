<?php
namespace core\model\table\sql;
class delete{
    
    public static function syntaxeSQL($data,$table) {
       
        $sql = 'delete from  '
                . $table
                . '  where id = '
                . $data['id'];
        return $sql;
    }
    
}
