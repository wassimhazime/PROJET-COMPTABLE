<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use core\RunMvc;

class Midd_PSR7_MVC implements Interface_Midd_PSR7
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {

      
        $MVC = new RunMvc();
         $response=$MVC->run($request, $response);
         return $next($request, $response);
    }
}
