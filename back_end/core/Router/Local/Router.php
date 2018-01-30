<?php

namespace core\Router\Local;

use core\Router\InterfaceRouter\RouterInterface;
use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{

    private $siApatch = '';

    function setSiApatch($siApatch)
    {
        $this->siApatch = $siApatch;
    }

    private $routes = [];
    private $namedroutes = [];

    public function get(string $url, callable $callable, string $name)
    {
         $this->method("GET", $url, $callable, $name);
    }

//    public function post(string $path, callable $callable, string $name = ""): Route
//    {
//        return $this->method("POST", $path, $callable, $name);
//    }

    
    
    
    
    
    
    private function method(string $method, string $path, callable $callable, string $name)
    {
        $route = new Route($path, $callable, $name, $this->siApatch);

        $this->routes[$method][] = $route;
        $this->namedroutes[$route->getNameRoute()] = $route;
        return $route;
    }

    public function match(ServerRequestInterface $Request, ResponseInterface $Response): ResponseInterface
    {
        

        foreach ($this->routes[$Request->getMethod()] as $route) {
            if ($route->match($Request)) {
                return $route->call($Request, $Response);
                break;
            }
        }

        return ((new Response(404))->withHeader('Location', "/"));
    }

    
    ///tools
    public function generateUri(string $name, array $substitutions = [])
    {
        if (!isset($this->namedroutes[$name])) {
            throw new Exception(" not is name route");
        }
        $route = $this->namedroutes[$name];
        return $route->url($substitutions);
    }

    public function redirection(string $name, array $substitutions = [])
    {
        $url = $this->generateUri($name, $substitutions);
        
        return ((new Response(301))->withHeader('Location', $url));
    }
}
