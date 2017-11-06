<?php

namespace core;

use Psr\Http\Message\ServerRequestInterface as Req;
use Psr\Http\Message\ResponseInterface as Res;
use core\Router\Router;
use core\CONTROLLER\Controller;
use GuzzleHttp\Psr7\ServerRequest;

class Dispatcher {

    public static function load() {

        $app = new Router();
        $app->setSiApatch('/comptable/');




///get
        ///////////////////////////////////////////////////////////////////////////////////////       
        $app->get("/{Controleur}/{Action}", function (Req $Request, Res $Response) {
            echo 'nombre';
        }, "routeNombre"
        )->with("Controleur", "[1-9]*")->with("Action", "[1-9]*");
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("{Controleur}/{Action}", function (Req $Request, Res $Response) {
            return Controller::executer($Request, $Response);
        }, "routeMVC"
        )->with("Controleur", "[a-z\-_]*")->with("Action", "[a-z\-_]*");
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("/{Controleur}", function (Req $Request, Res $Response) use($app) {
            $c = $Request->getAttribute('params_match')[0];
            $app->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
        });
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("/", function (Req $Request, Res $Response) use($app) {
            $app->redirection("routeMVC", ["Controleur" => "index", "Action" => "index"]);
        });
        ///////////////////////////////////////////////////////////////////////////////////////       
///post
        $app->post("/{Controleur}/{Action}", function (Req $Request, Res $Response)use($app) {
            $app->redirection("routeMVC", ["Controleur" => "index", "Action" => "index"]);
        });


        /////       
        //  $app->run(new ServerRequest("GET", "/")); //stop page

        $Response = $app->run(ServerRequest::fromGlobals());
        //  send($Response);
    }

}
