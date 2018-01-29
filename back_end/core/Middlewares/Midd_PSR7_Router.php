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

class Midd_PSR7_Router implements Interface_Midd_PSR7 {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface {

        $app = new Router();
        $MVC = new RunMvc();
        $app->setSiApatch('/comptable/');



///get
        ///////////////////////////////////////////////////////////////////////////////////////       
        $app->get("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) {
            echo 'nombre';
        }, "routeNombre"
        )->with("Controleur", "[1-9]*")->with("Action", "[1-9]*");
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response) use($MVC) {
            return $MVC->run($Request, $Response);
        }, "routeMVC"
        )->with("Controleur", "[a-z\-_]*")->with("Action", "[a-z\-_]*");
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("/{Controleur}", function (ServerRequestInterface $Request, ResponseInterface $Response) use($app) {
            $c = $Request->getAttribute('params_match')[0];
            return $app->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
        });
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("/", function (ServerRequestInterface $Request, Res $Response) use($app) {

            return $app->redirection("routeMVC", ["Controleur" => "index", "Action" => "index"]);
        });
        ///////////////////////////////////////////////////////////////////////////////////////       
///post
        $app->post("/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response)use($app, $MVC) {
            $MVC->run($Request, $Response);
            $c = $Request->getAttribute('params_match')[0];
            return $app->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
        });







        return $next($request, $app->run($request));
    }

}
