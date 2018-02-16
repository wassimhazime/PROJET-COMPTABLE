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

class Midd_PSR7_addRoute implements Interface_Midd_PSR7 {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface {
        echo 'Midd_PSR7_addRoute';

        $router = Router::getRouter();


        //$router->setSiApatch('/comptable/');
        $router->get("achat/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($next) {
            return $next($Request, $Response);
        }, "routeMVCLocal");

        $router->get("achat/{Controleur:[a-z0-9\_\-]+}/{Action:[a-z0-9\-]+}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($next) {

            return $next($Request, $Response);
        }, "routeMVCFastroute");


        $router->get("achat/{Controleur}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($router, $next) {
            $c = $Request->getAttribute('params_match')[0];

            return $router->redirection("routeMVCLocal", ["Controleur" => $c, "Action" => "index"]);
        }, "red2");

        $router->get("achat/", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($router) {

            return $router->redirection("routeMVCLocal", ["Controleur" => "index", "Action" => "index"]);
        }, "red1");

        return $next($request, $response);






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
        ///////////////////////////////////////////////////////////////////////////////////////
///post
//        $router->post("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use ($router, $MVC) {
//            $MVC->run($Request, $Response);
//            $c = $Request->getAttribute('params_match')[0];
//            return $router->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
//        });
    }

}
