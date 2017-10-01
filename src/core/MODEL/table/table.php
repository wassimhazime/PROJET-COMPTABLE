<?php

//– LDD, LMD & LCT
//LDD : langage de< définition> des données
//Colonnes
//Tables
//Contraintes
//Tables et contraintes
//LMD : langage de <manipulation> des données
//Insertion :insert
//Mise à jour :update
//Suppression :delete
//LCT : langage de< contrôle> des transactions
//Validation :commit
//Annulation :rollback

namespace core\model\table;
use core\model\table\sql\SQL;



use core\model\table\sql\update;


use core\model\table\sql\join;

class table {

    private $nom;
    function getNom() {
        return $this->nom;
    }

    
    public function __construct($nom ) {
        $this->nom = $nom;
    }

    public function update($data, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }

        $sql = update::syntaxeSQL($data, $table);
        return $sql;
    }

    public function delete($condition, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        return SQL::delete($condition)->from($table);
        
    }

    public function insert($data, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
//        $sql = Insert::syntaxeSQL($data, $table);
//        return $sql;
        $id='id_'.$table;
        
        unset($data[$id]);
        
       
        return SQL::insertInto($table)->value($data);
    }

    public function Select($champ, $condition, $table = null) {
        if ($table == null) {$table = $this->nom;}

          return SQL::select($champ)->from($table);
    }

   public function join($Select,$TABLEpere,$TABLEenfant,$condition) {
      
        
        $sql = Join::syntaxeSQL($Select,$TABLEpere,$TABLEenfant,$condition);
        
        return $sql;
    } 
    
     public function joinOrphelins($Select,$TABLEpere,$TABLEenfant) {
      
        
        $sql = Join::orphelins($Select,$TABLEpere,$TABLEenfant);
        
        return $sql;
    }
    
    
    
    public function selectSchema( $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        
        
        
        return SQL::select("COLUMN_NAME")
                            ->from(" INFORMATION_SCHEMA.COLUMNS ")
                             ->where("TABLE_SCHEMA = 'comptable'", "TABLE_NAME = '$table'");
       
    }

    
}
