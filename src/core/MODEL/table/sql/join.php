<?php



namespace core\model\table\sql;
use core\model\table\sql\SQL;

class Join {
    
 public static function syntaxeSQL($select,$TABLEpere,$TABLEenfant,$condition) {
    
        return SQL::select($select)
        ->from($TABLEpere)
        ->join($TABLEenfant,"LEFT",true)
        ->join("raison_sociale")
        ->where("$idPere=$condition");
    }

 public static function orphelins($select,$TABLEpere,$TABLEenfant) {
      return SQL::select($select.",RAISON_SOCIALE_raison_sociale")
          ->from($TABLEenfant)
          ->join("raison_sociale")       
          ->independent($TABLEpere)
      
         ;
    }
 }
