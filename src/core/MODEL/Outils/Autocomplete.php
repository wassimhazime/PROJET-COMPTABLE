<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\MODEL\Outils;
use core\MODEL\Entitys\EntitysTable;
use core\MODEL\Base_Donnee\RUN;


class Autocomplete extends RUN{
     
    
     function __construct() {
        parent::__construct(new EntitysTable());
    }
    
 
    
    public static function getAutocomplete($table) {
        $describe = (new self)->run("SHOW COLUMNS FROM " .
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
        
        
     return (new self)->run('SELECT ' .$colums. ' FROM '.$table);
    }
    
  
    
    
}
