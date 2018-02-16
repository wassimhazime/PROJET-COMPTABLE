<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

use core\MVC\CONTROLLER\Controller;
use core\MVC\MODEL\Model;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Description of Run
 *
 * @author Wassim Hazime
 */
class RunMvc
{

    private $name = "";
    private $action = "";

    function __construct()
    {
    }

    public function run(Request $Request, Response $Response):Response
    {

        $Request = $this->parsse_Params_match_to_Params_MVC($Request);
        $obController = $this->get_Object_Controller($Request, $Response);
        $obModel = $this->get_Object_Model();
        
        $view = $obController->run($obModel);/// core
        
        $container =  $this->render($view);
          $Response->getBody()->write($container);
          return $Response;
    }

   
    
    
    private function parsse_Params_match_to_Params_MVC(Request $Request)
    {
        
        
        var_dump($Request->getAttributes());
        
        $params_match = $Request->getAttribute('params_match');
        $params=[];
        foreach ($params_match as $key => $value) {
            $params[]  =$value;
        }
        var_dump($params);
        $this->name = $params[0];
        $this->action = $params[1];
        $mvc = [];

        if (!empty($params[0])and isset($params[0])) {
            $mvc["controller"] = $params[0];
        } else {
            $mvc["controller"] = "index";
        }
        if (!empty($params[1])and isset($params[1])) {
            $mvc["action"] = $params[1];
        } else {
            $mvc["action"] = "index";
        }
        if (!empty($params[2])and isset($params[2])) {
            $mvc["param"] = $params[2];
        } else {
            $mvc["param"] = "";
        }

        return $Request->withAttribute("MVC", $mvc);
    }

    private function get_Object_Controller(Request $Request, Response $Response): Controller
    {

        $controller = $this->get_Class("Controller");
        return new $controller($Request, $Response);
    }

    private function get_Object_Model(): Model
    {

        $model = $this->get_Class("Model");

        return new $model($this->name);
    }

    private function get_Class(string $mvc): string
    {
        
           $classMVC =  'app\\module_achat\\' . $mvc . '\\MANUAL\\'  . $mvc . '_' . $this->name;
        if (!class_exists($classMVC)) {
            $classMVC = 'app\\module_achat\\' .  $mvc . '\\' . $mvc . '_DEFAULT';
        }
         return$classMVC;
    }

    private function render(array $variable = [])
    {
            
        if ($variable != []) {
            ob_start();
             $this->charge_page($variable);
            $container = ob_get_clean();
            
            ob_start();
            require ConfigPath::getPath("templeteROOT") . 'themes.php';
            return ob_get_clean();
        } else {
            ob_start();
            require ConfigPath::getPath("templeteROOT") . '404.php';
            return ob_get_clean();
        }
    }

    private function charge_page(array $variable)
    {
        extract($variable);
        
        $page = $this->name . D_S . $this->action;

        $chemin = ConfigPath::getPath("views_MANUAL") . $page . '.php';

        if (is_file($chemin)) {
            require $chemin;
        } else {
            $page = $this->action;
            $chemin = ConfigPath::getPath("views_DEFAULT") . $page . '.php';
            require $chemin;
        }
    }
}
