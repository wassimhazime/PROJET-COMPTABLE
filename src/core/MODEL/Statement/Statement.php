<?php



namespace core\model\Statement;

use core\model\Query\QuerySQL;


class Statement  implements I_Statement {

    private $table;
    

    function getTable() {
        return $this->table;
    }

        public function __construct($nom) {
        $this->table = $nom;
        
    }

    public function update($data, $condition) {

        return (new QuerySQL())
                ->update($this->table)
                ->set($data)
                ->where($condition);
    }

    public function delete($condition) {
      
        return (new QuerySQL())
                ->delete($condition)
                ->from($this->table);
    }

    public function insert($data) {
      
        unset($data['id']);
        
        return (new QuerySQL())->
                insertInto($this->table)
                ->value($data);
    }

   
    public function Select($champ, $condition) {
     return (new QuerySQL())->select($champ)
                        ->from($this->table)
                         ->where($condition);
    }

    
    public function show(array $show,$condition =" 1 ") {
       
       $Select= $show["select"];
       $TABLEpere= $show["pere"];
        $TABLEenfant=$show["enfant"];
        $TABLEalias=  $show["alias"];
        $sqlpere= (new QuerySQL())->select($Select['pere'])
                        ->from($TABLEpere)
                        
                        ->join($TABLEalias)
                        ->where($condition)
                ;
        
        $sqlenfant= (new QuerySQL())->select($Select['enfant'])
                        ->from($TABLEpere)
                        ->join($TABLEenfant, "LEFT", true)
                        
                        ->where($condition)
                ;
                
                return ["pere"=>$sqlpere,"enfant"=>$sqlenfant];
    }
    
    
    public function join($Select, $TABLEpere, $TABLEenfant, $condition) {
        $selectarry= explode(",", $Select);
        $sele=[];
        foreach ($selectarry as $sele) {
          $s[]=  "$TABLEenfant.$sele";
        }
        
        $sql= (new QuerySQL())->select(implode(",", $s),"raison_sociale.raison_sociale")
                        ->from($TABLEpere)
                        ->join($TABLEenfant, "LEFT", true)
                        ->join("raison_sociale")
                        ->where($condition)
                ;
                var_dump($sql."");
                return $sql;
    }

    public function independent($Select,  $TABLEenfant) {

        return (new QuerySQL())->select($Select)
                        ->from($TABLEenfant)
                        ->join("raison_sociale")
                        ->independent($TABLEpere);
    }

    public function selectSchema() {
        
        return (new QuerySQL())->select("COLUMN_NAME")
                        ->from(" INFORMATION_SCHEMA.COLUMNS ")
                        ->where("TABLE_SCHEMA = 'comptable'", "TABLE_NAME = '".$this->table."'");
    }

}
