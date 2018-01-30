<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use core\Router\Local\Router;

class Midd_PSR7_Router implements Interface_Midd_PSR7
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {

        $router = new Router();
       
        
        //$router->setSiApatch('/comptable/');
         $router->get("achat/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($next) {
               return $next($Request, $Response);
         }, "routeMVCLocal");

          $router->get("achat/{Controleur:[a-z0-9\_\-]+}/{Action:[a-z0-9\-]+}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($next) {
            
                 return $next($Request, $Response);
          }, "routeMVCFastroute");

///get
//        ///////////////////////////////////////////////////////////////////////////////////////
//        $router->get("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) {
//            echo 'nombre';
//        }, "routeNombre")->with("Controleur", "[1-9]*")->with("Action", "[1-9]*");
/////////////////////////////////////////////////////////////////////////////////////////
//        $router->get("{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($MVC) {
//            return $MVC->run($Request, $Response);
//        }, "routeMVC")->with("Controleur", "[a-z\-_]*")->with("Action", "[a-z\-_]*");
///////////////////////////////////////////////////////////////////////////////////////
        $router->get("/{Controleur}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($router, $next) {
            $c = $Request->getAttribute('params_match')[0];
           
            return $router->redirection("routeMVCLocal", ["Controleur" => $c, "Action" => "index"]);
        }, "red2");
///////////////////////////////////////////////////////////////////////////////////////
        $router->get("/", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($router) {

            return $router->redirection("routeMVCLocal", ["Controleur" => "index", "Action" => "index"]);
        }, "red1");
        ///////////////////////////////////////////////////////////////////////////////////////
///post
//        $router->post("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($router, $MVC) {
//            $MVC->run($Request, $Response);
//            $c = $Request->getAttribute('params_match')[0];
//            return $router->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
//        });





        $response=$router->match($request, $response);

        return $response;
    }
}
