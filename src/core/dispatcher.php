<?php
namespace core;
use core\routeur\Requete;
use core\routeur\Routeur;
use core\Controller\controller;
use core\routeur\Session;

class dispatcher {
 

   public static function load(){
       Session::set('url', (new  Requete())->getURL());
       $request =new  Requete();
      $route=Routeur::parst($request) ;
     controller::executer($route);
       
//      
//       
// $app = new \Slim\App([
//       'settings' => ['displayErrorDetails' => true, ],
//]);

//$app->get('/', 
//        function ($request, $response, $args) {
//    
//       $_GET['controleur']="index";
//      $request =new  Requete();
//      $parst=Routeur::parst($request) ;
//     controller::executer($parst);
//     
//   return $response->write("Hello, " );
//     
//});
//
//
//
//$app->get('/{controleur}/{action}',
//        function ($request, $response, $args) {
//    
//       $_GET['controleur']=$args['controleur'];
//       $_GET['action']=$args['action'];
//      $request =new  Requete();
//      $parst=Routeur::parst($request) ;
//     controller::executer($parst);
//     
//   return $response->write("Hello, " );
//     
//});
//$app->run();
       
       
      
   }
    
}