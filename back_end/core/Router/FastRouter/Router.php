<?php

namespace core\Router\FastRouter;

use core\Router\InterfaceRouter\RouterInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Zend\Expressive\Router\Route as FastRoute;

class Router implements RouterInterface
{
    
    
    
        static $routers=null;
    public static function getRouter():self{
        if(is_null(self::$routers))
        {
        self::$routers= new self();
        }
        return self::$routers;
    }

    private $router;

    function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    public function get(string $url, callable $callable, string $name)
    {
        $route = new FastRoute($url, $callable, ['GET'], $name);
        $this->router->addRoute($route);
    }

    public function generateUri(string $name, array $substitutions = [])
    {
        return $this->router->generateUri($name, $substitutions, $options);
    }

    public function redirection(string $name, array $substitutions = [])
    {
        $url = $this->generateUri($name, $substitutions);
        return ((new Response(301))->withHeader('Location', $url));
    }

    public function match(ServerRequestInterface $Request, ResponseInterface $Response): ResponseInterface
    {
        $routeResulte = $this->router->match($Request);


        if ($routeResulte->isSuccess()) {
            $params = $routeResulte->getMatchedParams();
            $Request = $Request->withAttribute("params_match", $params);
            $callable = $routeResulte->getMatchedMiddleware();
            $Resp = call_user_func_array($callable, [$Request, $Response]);
            $name = $routeResulte->getMatchedRouteName();


            if ($Resp instanceof ResponseInterface) {
                return $Resp;
            } else {
                $Response->getBody()->write($Resp);
                return $Response;
            }
        } else {
            return $Response;
        }
    }
}
