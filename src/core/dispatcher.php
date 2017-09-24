<?php
namespace core;
use core\routeur\Requete;
use core\routeur\Routeur;
use core\Controller\controller;
use core\routeur\Session;

class dispatcher {
 

   public static function load(){
       
       $request =new  Requete();
       Session::set('url', $request->getURL());
       $parst=Routeur::parst($request) ;
       
        controller::executer($parst);
      
   }
    
}