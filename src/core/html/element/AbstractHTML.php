<?php

namespace core\html\element;


class AbstractHTML {
    
            
    function __construct() {
        
    }

    public function a($href,$value) {
        return "<a href={$href}  > {$value} </a>";  
    }
 
    public function chargeListHtml($item, $param = '', $balis = 'option ') {
        
       $id='id';
      
        $option = "<$balis $param " . " value =rien>select champ</$balis>";
        foreach ($item as $c) {
            $op = '';

            foreach ($c as $key => $value) {
               
                $op .= $key . '<>' . $value . '  ||  ';
            }
            $option .= "<$balis $param " . " value ={$c->$id}> $op </$balis>"
            ;
        }
    return $option;
    } 
 

}
