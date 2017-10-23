<?php



namespace core\html\element\form;
use core\INTENT\Intent;

class InputHTML {
  
  
  public function set(array $COLUMNS_META) {
      
      
  }
  
  
  
    public  function parse(Intent $intent) {
        
        $this->set( $intent->getEntitysSchema()->getCOLUMNS_META());
        $InputHTML=[];
        foreach ($metaFORM as $input) {
           $InputHTML[]=self::label($input) ;
           $InputHTML[]=self::input($input) ;
            
        }
        
    }
    
    
    
    
}
