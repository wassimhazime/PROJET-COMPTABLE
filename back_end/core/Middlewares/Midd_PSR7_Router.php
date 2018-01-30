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
use core\RunMvc;

class Midd_PSR7_Router implements Interface_Midd_PSR7
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {

        $route = new Router();
        $MVC = new RunMvc();
        
        //$route->setSiApatch('/comptable/');
         $route->get("{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($MVC) {
            return $MVC->run($Request, $Response);
         }, "routeMVCLocal");

          $route->get("/{Controleur:[a-z0-9\_\-]+}/{Action:[a-z0-9\-]+}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($MVC) {
            
              return $MVC->run($Request, $Response);
          }, "routeMVCFastroute");

///get
//        ///////////////////////////////////////////////////////////////////////////////////////
//        $route->get("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) {
//            echo 'nombre';
//        }, "routeNombre")->with("Controleur", "[1-9]*")->with("Action", "[1-9]*");
/////////////////////////////////////////////////////////////////////////////////////////
//        $route->get("{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($MVC) {
//            return $MVC->run($Request, $Response);
//        }, "routeMVC")->with("Controleur", "[a-z\-_]*")->with("Action", "[a-z\-_]*");
///////////////////////////////////////////////////////////////////////////////////////
        $route->get("/{Controleur}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($route) {
            $c = $Request->getAttribute('params_match')[0];
            return $route->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
        }, "red2");
///////////////////////////////////////////////////////////////////////////////////////
        $route->get("/", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($route) {

            return $route->redirection("routeMVC", ["Controleur" => "index", "Action" => "index"]);
        }, "red1");
        ///////////////////////////////////////////////////////////////////////////////////////
///post
//        $route->post("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($route, $MVC) {
//            $MVC->run($Request, $Response);
//            $c = $Request->getAttribute('params_match')[0];
//            return $route->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
//        });





        $response=$route->match($request, $response);

        return $next($request, $response);
    }
}
