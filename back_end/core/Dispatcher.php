<?php
namespace core;
use core\routeur\Requete;
use core\routeur\Routeur;
use core\CONTROLLER\Controller;
use core\routeur\Session;

class Dispatcher {
 

   public static function load(){
       Session::set('url', (new  Requete())->getURL());
       $request =new  Requete();
      $route=Routeur::parst($request) ;
     Controller::executer($route);
       
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