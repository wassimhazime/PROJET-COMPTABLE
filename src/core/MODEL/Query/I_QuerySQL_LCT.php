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

namespace core\model\Query;

/**
 *
 * @author Wassim Hazime
 */
interface I_QuerySQL_LCT {


    
     //traitement
    public function query() ;
    public function __toString();
    


}
