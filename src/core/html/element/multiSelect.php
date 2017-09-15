<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\html\element;
use core\html\element\AbstractHTML;

/**
 * Description of multiSelect
 *
 * @author Wassim Hazime
 */
class multiSelect extends AbstractHTML{
  function __construct() {
        parent::__construct();
    }

   
    
    public function multiselect($item,$filds, $param = '', $balis = 'option ') {
     
   return'<div class="ROOTmultiSelectItem">'
        .'<button type="button" class="close"><span aria-hidden="true">&times;</span></button>'
           . '<select multiple  class="multiSelectItemwassim" name="'.$filds.'[]">'. 
           $this->chargeListHtml($item, $filds, $param, $balis).' </select>'
         . '</div>';
 }
 
 public function chargeListHtml($item,$filds, $param = '', $balis = 'option ') {
        
       $id='id_'.$filds;
       
        $option = "";
        foreach ($item as $c) {
          if(!isset($c->$id)) { return "<$balis></$balis>";} 
            $op = '';

            foreach ($c as $key => $value) {
                $key =str_replace('_'.$filds, '', $key);
                $op .= $key . '$$$' . $value . ' £££ ';
            }
            $popover='data-container="body" data-toggle="popover" data-placement="top" data-content="' .$op.'"' ;
            $option .= "<$balis $param $popover " . "  value ={$c->$id}> $op </$balis> "
            ;
        }
    return $option;
    } 
 
 
 
}
