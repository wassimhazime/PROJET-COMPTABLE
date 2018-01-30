<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\Router\InterfaceRouter;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 *
 * @author wassime
 */
interface RouterInterface
{

    public function get(string $url, callable $callable, string $name);

    // $uri =  $this->router->generateUri("blogueuri", ["str" => "awa-modif-44", "id" => "99"]);
    public function generateUri(string $name, array $substitutions = []);

    public function redirection(string $name, array $substitutions = []);

    public function match(ServerRequestInterface $Request, ResponseInterface $Response): ResponseInterface;
}
