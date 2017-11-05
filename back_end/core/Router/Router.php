<?php

namespace core\Router;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class Router {

    private $Request;
    private $Response;
    private $routes = [];

    public function __construct() {

        $this->Response = new Response();
    }

    public function get(string $path, callable $callable): Route {
        return $this->method("GET", $path, $callable);
    }

    public function post(string $path, callable $callable): Route {
        return $this->method("POST", $path, $callable);
    }

    private function method(string $method, string $path, callable $callable) {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function run($Request) {
        $this->Request = $Request;

        foreach ($this->routes[$this->Request->getMethod()] as $route) {
            if ($route->match($this->Request->getUri()->getPath())) {
                $route->call($this->Request, $this->Response);
            }
        }
        return $this->Response;
    }

}
