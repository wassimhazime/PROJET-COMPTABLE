<?php

namespace core;

use function Http\Response\send;
use core\Router\Router;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use core\CONTROLLER\Controller;

class Dispatcher {

    public static function load() {

        $app = new Router();

       
///get
        $app->get("/comptable/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response)  {
            return Controller::executer($Request, $Response);
        });

        $app->get("/comptable/{Controleur}", function (ServerRequestInterface $Request, ResponseInterface $Response)  {

            return Controller::executer($Request, $Response);
        });

        $app->get("/comptable/", function (ServerRequestInterface $Request, ResponseInterface $Response)  {

            return Controller::executer($Request, $Response);
        });
///post
        $app->post("/comptable/{Controleur}/{Action}", function (ServerRequestInterface $Request, ResponseInterface $Response)
                 {

            Controller::executer($Request, $Response);

            send($Response->withStatus(301)
                            ->withHeader("Location", "/comptable/"));

            return $Response;
        });


        //  $app->run(new ServerRequest("GET", "/comptable/")); //stop page

        $Response = $app->run(ServerRequest::fromGlobals());
    }

}
