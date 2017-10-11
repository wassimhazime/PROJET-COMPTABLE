<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\model\Statement;

/**
 *
 * @author Wassim Hazime
 */
interface I_Statement {
    
    

    public function __construct($nom);

    public function update($data, $condeion);

    public function delete($condition); 
   
    public function Select($champ, $condition) ;

    
    public function show(array $champ,$option =" 1 ");
    
    
    public function join($Select, $TABLEpere, $TABLEenfant, $condition); 

    public function independent($Select, $TABLEenfant);

    public function selectSchema() ;
    
    
    
}
