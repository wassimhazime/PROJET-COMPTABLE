<?php

namespace core\Router;

use GuzzleHttp\Psr7\ServerRequest;




class Router {
    private $url; // qui passe par navegateur
    private $routes=[];
    public function __construct() {
         $req = ServerRequest::fromGlobals();
        
        $url=$req->getUri()->getPath();  
         // /comptable/bl/index
        
        if (empty($url)) {
            $url="/";
        }
        $this->url = $url;
    }
    public function get(string $path, callable $callable) :Route{
     return   $this->method("GET", $path, $callable);
    
    }
    public function post(string $path, callable $callable) :Route{
     return  $this->method("POST", $path, $callable);     
    
    }
    
    
    
    private function method(string $method,string $path, callable $callable){
        $route=new Route($path, $callable);
        $this->routes[$method][]=$route;
        return $route;
        
    }

    public function run() {
        
        foreach ($this->routes[$_SERVER["REQUEST_METHOD"]] as $route) {
            if ($route->match($this->url) ) {
                $route->call();
            } 
        }
        
    }

}
