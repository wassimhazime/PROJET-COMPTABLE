<?php



namespace core\model\table\sql;

class join {
    
    public static function syntaxeSQL($select,$TABLEpere,$TABLEenfant,$condition) {
        
        
      $RD='d_'.$TABLEpere.'_'.$TABLEenfant;
      
     $idPere='id_'.$TABLEpere;
     $idEnfant='id_'.$TABLEenfant;
     
        $sql="SELECT $select FROM $TABLEpere "
                . "LEFT JOIN ("
                     . "$TABLEenfant INNER JOIN "
                           . $RD
                               . " ON $idEnfant = $idEnfant"."_detail"
                            . ") "
                                . "ON $idPere=$idPere"."_detail"
                ." where $idPere= $condition";
       
           
        return $sql;
    }

    public static function orphelins($select,$TABLEpere,$TABLEenfant) {
    $RD='d_'.$TABLEpere.'_'.$TABLEenfant;
    
     $idPere='id_'.$TABLEpere;
     $idEnfant='id_'.$TABLEenfant;
     
        return 'SELECT '.$select.'
FROM '.$TABLEenfant.'
LEFT JOIN '.$RD.' ON '.$RD.'.id_'.$TABLEenfant.'_detail ='.$TABLEenfant.'.'.$idEnfant.'
WHERE '.$RD.'.id_'.$TABLEenfant.'_detail IS NULL';
        
    }
 }
