<?php

namespace core\Router;
use function Http\Response\send;

use GuzzleHttp\Psr7\Response;


class Router {
    private $siApatch='';
    function setSiApatch($siApatch) {
        $this->siApatch = $siApatch;
    }

        
    private $routes = [];
    private $namedroutes = [];

   

    public function get(string $path, callable $callable, string $name=""): Route {
        return $this->method("GET", $path, $callable,$name);
    }

    public function post(string $path, callable $callable, string $name=""): Route {
        return $this->method("POST", $path, $callable,$name);
    }

    private function method(string $method, string $path, callable $callable, string $name) {
        $route = new Route($path, $callable,$name,$this->siApatch);
        
        $this->routes[$method][] = $route;
        $this->namedroutes[$route->getNameRoute()]=$route;
        return $route;
    }

    public function run($Request) {
        $Response = new Response();
        
        foreach ($this->routes[$Request->getMethod()] as $route) {
            
            
            if ($route->match($Request)) {
                $route->call($Request, $Response);
            }
         }
        
        return new Response(404);
    }
    
    ///tools
    public function get_URL(string $name, array $param=[]) {
        if(!isset($this->namedroutes[$name])){
           throw new \Exception(" not is name route"); 
        }
        $route=$this->namedroutes[$name];
        return  $route->url($param);
       
    }
    public function redirection(string $name, array $param=[]) {
        $url= $this->get_URL($name, $param);
       send((new Response(301))->withHeader("Location", $url));
        
    }

}
