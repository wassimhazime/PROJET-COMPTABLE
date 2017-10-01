<?php

namespace core\model\table\sql;

class Select {

   private $select = ["*"];
    private $from = [];
    private $conditions = ["1"];
    private $join=[];
   


    public function select() {
        $this->select = func_get_args();
        return $this;
    }

    public function from($table, $alias = null) {
        if (is_null($alias)) {
            $this->from[] = $table;
        } else {
            $this->from[] = "$table AS $alias";
        }
        return $this;
    }

    public function where() {
        if ($this->conditions == ["1"]) {
            $this->conditions = [];
        }
        foreach (func_get_args() as $arg) {
            $this->conditions[] = $arg;
        }

        return $this;
    }
    public function join($tablejoin,$type="INNER",$relation=false) {


     
        if($relation){
            $TABLEpere=$this->from[0];
            $TABLEenfant=$tablejoin;
            $RD='d_'.$TABLEpere.'_'.$TABLEenfant;
            
            
            //LEFT JOIN d_facture_bl     ON id_facture              =id_facture_detail
            $this->join[]= "  $type JOIN $RD     ON id_".$TABLEpere              ."=id_".$TABLEpere."_detail    "
            // LEFT      JOIN  bl             on id_bl                        =id_bl_detail
            . " $type JOIN $TABLEenfant         ON id_".$TABLEenfant              ."=id_".$TABLEenfant."_detail     ";
            
            
        }else{
            //INNER JOIN raison_sociale ON id_raison_sociale = raison_sociale_facture
            
            $this->join[]=" $type JOIN $tablejoin ON"
                . " id_".$tablejoin."  = ".$tablejoin."_".$this->from[0];
        }
        

        return $this;
    }
    public function query() {
        $select = ' SELECT ' . implode(', ', $this->select);
        $from = ' FROM ' . implode(', ', $this->from);
        $join=implode('  ',$this->join);
        $where = ' WHERE ' . implode(' AND ', $this->conditions);
        return $select . $from .$join. $where;
    }
    public function independent($master){
            $TABLE=$this->from[0];
            
            $RD='d_'.$master.'_'.$TABLE;
            //LEFT JOIN d_facture_bl ON id_bl_detail =id_bl
            $this->join[]="LEFT JOIN  $RD ON id_".$TABLE."_detail =id_".$TABLE;
            // WHERE id_bl_detail IS NULL
            $this->where("id_".$TABLE."_detail IS NULL");  
            return $this;
    }

    public function __toString() {
        return $this->query();
    }

    public static function syntaxeSQL($colunne, $condition, $table) {

        if ($condition != null) {
            $sql = "select $colunne from $table where ";
            $sql .= " `" . implode("`, `", array_keys($condition)) . "`";
            $sql .= " = '" . implode("', '", $condition) . "' ";
        } else {
            $sql = 'select ' . $colunne . ' from ' . $table;
        }
        return $sql;
    }

   

}
