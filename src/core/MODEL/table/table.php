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

use core\model\table\sql\insert;
use core\model\table\sql\update;
use core\model\table\sql\delete;
use core\model\table\sql\select;
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
    }

    public function insert($data, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        $sql = insert::syntaxeSQL($data, $table);
        return $sql;
    }

    public function select($champ, $condition, $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        
        $sql = select::syntaxeSQL($champ, $condition, $table);
        
        return $sql;
    }

   public function join($select,$TABLEpere,$TABLEenfant,$condition) {
      
        
        $sql = join::syntaxeSQL($select,$TABLEpere,$TABLEenfant,$condition);
        
        return $sql;
    } 
    
     public function joinOrphelins($select,$TABLEpere,$TABLEenfant) {
      
        
        $sql = join::orphelins($select,$TABLEpere,$TABLEenfant);
        
        return $sql;
    }
    
    
    
    public function selectSchema( $table = null) {
        if ($table == null) {
            $table = $this->nom;
        }
        
        $sql = select::syntaxeSchemaSQL( $table);
        return $sql;
    }

    
}
