<?php
namespace core;
use core\routeur\Requete;
use core\routeur\Routeur;
use core\Controller\controller;

class dispatcher {
 

   public static function load(){
      $request =new  Requete();
     $parst=Routeur::parst($request) ;
      controller::executer($parst);
      
   }
    
}