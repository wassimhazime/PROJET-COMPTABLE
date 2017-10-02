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

namespace core\model\table\sql;

/**
 *
 * @author Wassim Hazime
 */
interface InterfaceQuerySQL_LDD {
    public function select() ;

    public function from(string $table, string $alias = '') ;

    public function where() ;

    public function join(string $tablejoin, string $type = "INNER",bool $relation = false) ;

    public function independent(string $master);

    
  
    


}
