<?php

namespace core;

use Psr\Http\Message\ServerRequestInterface as Req;
use Psr\Http\Message\ResponseInterface as Res;
use core\Router\Router;
use core\RunMvc;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;

class Dispatcher {

    public static function load() {

        $app = new Router();
        $MVC = new RunMvc();
        $app->setSiApatch('/comptable/');




///get
        ///////////////////////////////////////////////////////////////////////////////////////       
        $app->get("/{Controleur}/{Action}", function (Req $Request, Res $Response) {
            echo 'nombre';
        }, "routeNombre"
        )->with("Controleur", "[1-9]*")->with("Action", "[1-9]*");
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("{Controleur}/{Action}", function (Req $Request, Res $Response) use($MVC) {
            return $MVC->run($Request, $Response);
        }, "routeMVC"
        )->with("Controleur", "[a-z\-_]*")->with("Action", "[a-z\-_]*");
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("/{Controleur}", function (Req $Request, Res $Response) use($app) {
            $c = $Request->getAttribute('params_match')[0];
            return $app->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
        });
///////////////////////////////////////////////////////////////////////////////////////
        $app->get("/", function (Req $Request, Res $Response) use($app) {

            return $app->redirection("routeMVC", ["Controleur" => "index", "Action" => "index"]);
        });
        ///////////////////////////////////////////////////////////////////////////////////////       
///post
        $app->post("/{Controleur}/{Action}", function (Req $Request, Res $Response)use($app, $MVC) {
            $MVC->run($Request, $Response);
            $c = $Request->getAttribute('params_match')[0];
            return $app->redirection("routeMVC", ["Controleur" => $c, "Action" => "index"]);
        });





        $Response = $app->run(ServerRequest::fromGlobals());

        send($Response);
    }

}
