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
interface I_QuerySQL_LMD {
    

    public function from(string $table, string $alias = '') ;

    public function where() ;

   

    ///delete
    public function delete();

    //insert

    public function insertInto(string $table) ;

    public function value(array $data);

    //update

    public function update(string $table) ;

    public function set(array $data) ;

   
    


}
