<?php
namespace core\model\table\sql;
class update{
    
    public static function syntaxeSQL($data,$table) {
      $id='id_'.$table;
        $l = "";
        foreach ($data as $x => $x_value) {
            if ($x != $id) {
                if ($l == "") {
                    $l = '`' . $x . '`' . '=' . '\'' . $x_value . '\'';
                } else {
                    $l .= " , " . '`' . $x . '`' . '=' . '\'' . $x_value . '\'';
                }
            }
        }

        $sql = 'update  '
                . $table
                . '  set '
                . $l
                . '  where '.$id.'  = '
                . $data[$id];

        return $sql;
    }
    
}
