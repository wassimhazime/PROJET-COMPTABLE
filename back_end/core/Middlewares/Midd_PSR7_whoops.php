<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use \Whoops\Run;
use \Whoops\Handler\PrettyPageHandler;

class Midd_PSR7_whoops implements Interface_Midd_PSR7 {

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface {

/// Handler error
(new Run)
        ->pushHandler(new PrettyPageHandler)
        ->register();


        return $next($request, $response);
    }

}
