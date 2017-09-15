<?php

namespace core ;


class Autoloader{
    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'))    ;

    }
    
    static function autoload($class){
         $ul= ROOT.$class.'.php';
         $ul=strtolower($ul);//Renvoie une chaîne en minuscules
         $ul=str_replace('\\','/',$ul); // problime window linux 
       require $ul;
           
      
        
        
    }
    
    
    
    
}


