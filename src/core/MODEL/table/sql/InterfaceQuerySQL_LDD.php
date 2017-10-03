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
    public function    column();
    
//where
    public function where() ;
    public function whereNot(string $column,string $value);
    public function whereNotBETWEEN(string $column, $valeur1,$valeur2);
    public function whereIn(string $column, array $range);
    public function whereBETWEEN(string $column, $valeur1,$valeur2);
    public function whereLike(string $column, $LIKE);
    public function whereNULL(string $column);
 
    
//join
    public function join(string $tablejoin, string $type = "INNER",bool $relation = false,string $conditions='') ;
    public function joinAlias(string $table,string $alias,string $conditions, $type = "INNER");
    public function independent(string $master);

    
   //having
//public function having($column, $value);
//public function havingIn($column, array $values);
//public function havingLike($column, $value);
//public function havingNot($column, $value);
//public function havingRaw($sql, $parameters);

    


//public function group($column, $direction = null);



//public function limit($limit);
//public function offset($offset);
//public function order($column, $direction = null);
//public function prependColumn($column, $alias = null);
//public function type($type);


  
    


}
