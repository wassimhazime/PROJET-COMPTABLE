<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\MODEL\Outils;
use core\MODEL\Entitys\EntitysDataTable;
use core\MODEL\Base_Donnee\RUN;


class Autocomplete extends RUN{
     
    
     function __construct() {
        parent::__construct(new EntitysDataTable());
    }
    
 
    
    public static function getAutocomplete($table): array {
        $describe = (new self)->query("SHOW COLUMNS FROM " .
                $table.
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' and "
                . "`Key`!='MUL' "
                );
        $select = [];

        foreach ($describe as $champ) {
       $select[] = $champ->Field;
        }
        
        $colums= implode(' , ', $select); 
        
        $return=(new self)->query('SELECT ' .$colums. ' FROM '.$table);
        
     return $return;
    }
    
  
    
    
}
