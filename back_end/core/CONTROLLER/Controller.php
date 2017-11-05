<?php

namespace core\CONTROLLER;

use core\html\TAG;
use core\INTENT\Intent;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;

class Controller {

    protected $model;
    protected $Request;
    protected $Response;
    protected $name;
    protected $action;

    function __construct(ServerRequestInterface $Request, ResponseInterface $Response) {
        $this->Request = $Request;
        $this->Response = $Response;

        $this->name = $Request->getAttribute('MVC')["controller"];
        $this->action = $Request->getAttribute('MVC')["action"];
        $this->param = $Request->getAttribute('MVC')["param"];


        if ($this->name != 'index') {
            $this->setModel($this->name);
        }
    }

    public static function executer(ServerRequestInterface $Request, ResponseInterface $Response) {

        $params = $Request->getAttribute('params_match');
        $mvc = [];

        if (!empty($params[0])and isset($params[0])) {
            $mvc["controller"] = $params[0];
        } else {
            $mvc["controller"] = "index";
        }
        if (!empty($params[0])and isset($params[1])) {
            $mvc["action"] = $params[1];
        } else {
            $mvc["action"] = "index";
        }
        if (!empty($params[2])and isset($params[2])) {
            $mvc["param"] = $params[2];
        } else {
            $mvc["param"] = "";
        }




        $controllerFile = D_S . 'app' . D_S . 'controller' . D_S . 'MANUAL' . D_S . 'Controller_' . $mvc["controller"];

        if (is_file(ROOT . 'back_end' . $controllerFile . '.php')) {
            
        } else {
            $controllerFile = D_S . 'app' . D_S . 'controller' . D_S . 'Controller_DEFAULT';
        }



        // si server window 
        $controller = str_replace("/", "\\", $controllerFile);
        
        $Request = $Request->withAttribute("MVC", $mvc);
       
        $obController = new $controller($Request, $Response);
        if (is_callable(array($obController, $mvc["action"]))) {
             call_user_func(array($obController, $mvc["action"]), $mvc["param"]);
        } else {
            self::NotFound($Request, $Response);
        }
    }

    protected function setModel($model) {
        $_modelFile = D_S . 'app' . D_S . 'model' . D_S . 'MANUAL' . D_S . 'Model_' . $model;
        if (is_file(ROOT . 'back_end' . $_modelFile . '.php')) {
            
        } else {
            $_modelFile = D_S . 'app' . D_S . 'model' . D_S . 'Model_DEFAULT';
        }
        // si server window 
        $_model = str_replace("/", "\\", $_modelFile);
        try {
            $this->model = new $_model($model);
        } catch (\TypeError $exc) {

            self::NotFound();
            exit();
        }
    }

    protected function show(array $mode = Intent::MODE_SELECT_MASTER_MASTER, $condition = 1) {


        $intent = $this->model->show($mode, $condition);

        return (new TAG())->tableHTML($intent);
    }

    protected function getFormHTML(array $mode = Intent::MODE_FORM) {
        $intent = $this->model->form($mode);

        return (new TAG())->FormHTML($intent);
    }

    protected function setData($data, $mode = Intent::MODE_INSERT) {
        $intent = $this->model->setData($data, $mode);
    }

    public static function NotFound(ServerRequestInterface $Request=null, ResponseInterface $Response=null)  {
        
        ////////////
        
        echo "action or controller or model  NotFound";
        
        header("HTTP/1.0 404 Not Found");

        require ROOT .
                'back_end' . D_S .
                'app' . D_S .
                'views' . D_S .
                'templete' . D_S .
                '404.php';
    }

}
