<?php



namespace core\model\table;

use core\model\table\sql\QuerySQL;


class table {

    private $nom;
    private $id;

    function getNom() {
        return $this->nom;
    }

    public function __construct($nom) {
        $this->nom = $nom;
        $this->id = 'id_' . $nom;
    }

    public function update($data, $condeion, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        return (new QuerySQL())->update($table)->set($data)->where($condeion);
    }

    public function delete($condition, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        return (new QuerySQL())->delete($condition)->from($table);
    }

    public function insert($data, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        unset($data[$this->id]);
        return (new QuerySQL())->insertInto($table)->value($data);
    }

    public function Select($champ, $condition, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
     ///////test query sql   
        var_dump(
                
                
               ( new QuerySQL())->
                select()
                        ->from('produit')
                        ->independent("categorie")
               
                
                ."");
      
        return (new QuerySQL())->select($champ)
                        ->from($table)
                         ->where($condition);
    }

    public function join($Select, $TABLEpere, $TABLEenfant, $condition) {
        return (new QuerySQL())->select($Select)
                        ->from($TABLEpere)
                        ->join($TABLEenfant, "LEFT", true)
                        ->join("raison_sociale")
                        ->where($condition)
                ;
    }

    public function independent($Select, $TABLEpere, $TABLEenfant) {

        return (new QuerySQL())->select($Select)
                        ->from($TABLEenfant)
                        ->join("raison_sociale")
                        ->independent($TABLEpere);
    }

    public function selectSchema($table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        return (new QuerySQL())->select("COLUMN_NAME")
                        ->from(" INFORMATION_SCHEMA.COLUMNS ")
                        ->where("TABLE_SCHEMA = 'comptable'", "TABLE_NAME = '$table'");
    }

}
