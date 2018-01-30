<?php

namespace core\Router\Local;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Psr7\Response;

class Route
{

    private $siApatch = '';
    private $path; // path generate ex=>/test/ll/{bb}/
    private $callable; // function($Request, $Response) call
    private $nameRoute;


    /* // path generate ex=>/test/ll/{param}/
     * {param}=>$syntax_param_method_router='#{([a-zA-Z0-9]+)}#'
     * 
     * 
     * is call with("Action", "[a-z\-_]*")
     * $app->get("/{Controleur}/{Action}",
     *  function (ServerRequestInterface $Request, ResponseInterface $Response)  {
      return Controller::executer($Request, $Response);
      })->with("Controleur", "[a-z\-_]*")->with("Action", "[a-z\-_]*");
     * 
     * "[a-z\-_]*"==>$regex_pattern = [];
     * 
     * $params_match = [] => $Request->getAttribute('params_match'); Controleur and Action
     *  
     */
    private $syntax_param_method_router = '#{([a-zA-Z0-9]+)}#';
    private $regex_pattern = [];
    private $params_match = [];

    private function getRegex_pattern($ref): string
    {

        if (isset($this->regex_pattern[$ref])) {
            return $this->regex_pattern[$ref];
        }
        return '([^/]+)';
    }

    private function setRegex_pattern($ref, $regex_pattern)
    {
        $this->regex_pattern[$ref] = $regex_pattern;
    }

    function __construct(string $path, callable $callable, $name, $siApatch = '')
    {


        $this->path = trim($path, "/");
        $this->callable = $callable;
        $this->nameRoute = $name;
        $this->siApatch = $siApatch;
    }

    public function with($param, $regex): self
    {
        $regex = str_replace("(", "(?", $regex); //pour ne creier (
        $regex_pattern = "($regex)";
        $this->setRegex_pattern($param, $regex_pattern);
        return $this;
    }

    private function replace_callback($paramPath)
    {
        //$paramPath[0]=> match global {text}
        //$paramPath[1]=> group match    text
        return $this->getRegex_pattern($paramPath[1]);
    }

    public function match(\Psr\Http\Message\ServerRequestInterface $Request): bool
    {


        $path = preg_replace_callback(
            $this->syntax_param_method_router,
            [$this, 'replace_callback'],
            $this->path
        );

        $regex = "#^$path$#i"; ///=> '#^comptable/([a-z\-_]*)/([a-z\-_]*)$#i

        $url = $Request->getUri()->getPath();

        $url = str_replace($this->siApatch, "", $url); // server apatch

        $url = trim($url, "/");
        if (!preg_match($regex, $url, $match)) {
            return false;
        }

        array_shift($match); ///$match[0]=> 'comptable/commande/add'
        $this->params_match = $match;
        return true;
    }

    public function call(ServerRequestInterface $Request, ResponseInterface $Response): ResponseInterface
    {
        $Request = $Request->withAttribute("params_match", $this->params_match);
        $Resp = call_user_func_array($this->callable, [$Request, $Response]);
        if ($Resp instanceof ResponseInterface) {
            return $Resp;
        } else {
            $Response->getBody()->write($Resp);
            return $Response;
        }
    }

    public function url(array $param)
    {
        $path = $this->path;

        foreach ($param as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }
        return $this->siApatch . $path;
    }

    function getNameRoute()
    {
        return $this->nameRoute;
    }
}
