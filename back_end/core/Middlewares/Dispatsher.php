<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of midd_dispatsher
 *
 * @author wassime
 */

namespace core\Middlewares;

use Interop\Http\Server\RequestHandlerInterface;
use Interop\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;



use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;

class Dispatsher implements RequestHandlerInterface
{
    

    //singltone

    private static $self = null;

    public static function Dispatsher(): self
    {
        if (self::$self == null) {
            self::$self = new self();
        }
       
        return self::$self;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
     /////////////////////////////////////////////////////////////
     
    
    
    /////////////////////////////////////////////////////////////

    private $middlwares = [];
    private $response = null;

    /**
     *
     * @param \core\Middlewares\midd $midd
     * @return \self
     */
    public function pipe($midd) :self
    {
        if (is_string($midd)) {
             $midd=new $midd();
        }
        $this->middlwares[] = $midd;
        return $this;
    }

    public function next(ServerRequestInterface $request, ResponseInterface $respons): ResponseInterface
    {

        $this->response = $respons;
        if (count($this->middlwares)) {
            $middlwars = array_shift($this->middlwares);

            if ($middlwars instanceof MiddlewareInterface) {
                return $middlwars->process($request, $this);
            } elseif (is_callable($middlwars)) {
                return $middlwars($request, $respons, [$this, 'next']);
            } else {
                throw new \Exception(" pipe object is not Middlwars");
            }
        } else {
            return $respons;
        }
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->next($request, $this->response);
    }
    
    
    public function run()
    {
         $request = ServerRequest::fromGlobals();
         $respons = new Response();
         $response =    $this->next($request, $respons);
         send($response);
    }
}
