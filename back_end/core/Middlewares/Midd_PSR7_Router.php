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
echo 'Midd_PSR7_router';
        $router =  Router::getRouter();
        $response=$router->match($request, $response);
        return $next($request, $response);
        
    }
}
