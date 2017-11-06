<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

use core\CONTROLLER\Controller;
use core\MODEL\Model;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Description of Run
 *
 * @author Wassim Hazime
 */
class RunMvc {

    private $name = "";
    private $action = "";

    function __construct() {
        
    }

    public function run(Request $Request, Response $Response) {

        $Request = $this->parsse_Params_match_to_Params_MVC($Request);
        $obController = $this->get_Object_Controller($Request, $Response);
        $obModel = $this->get_Object_Model();
        $view = $obController->run($obModel);
        $this->render($view);
    }

    private function parsse_Params_match_to_Params_MVC(Request $Request): Request {
        $params = $Request->getAttribute('params_match');
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

    private function get_Object_Controller(Request $Request, Response $Response): Controller {

        $controller = $this->get_Class("Controller");
        return new $controller($Request, $Response);
    }

    private function get_Object_Model(): Model {

        $model = $this->get_Class("Model");

        return new $model($this->name);
    }

    private function get_Class(string $mvc): string {

        $classMVC = D_S . 'app' . D_S . $mvc . D_S . 'MANUAL' . D_S . $mvc . '_' . $this->name;

        if (is_file(ROOT . 'back_end' . $classMVC . '.php')) {
            
        } else {
            $classMVC = D_S . 'app' . D_S . $mvc . D_S . $mvc . '_DEFAULT';
        }

        return str_replace("/", "\\", $classMVC);
    }

    ////view
    /// show view
    protected function render(array $variable = []) {
        if ($variable != []) {
            ob_start();
            $this->charge_page($variable);
            $container = ob_get_clean();
            require ROOT .
                    'back_end' . D_S .
                    'app' . D_S .
                    'views' . D_S .
                    'templete' . D_S .
                    'themes.php';
        } else {
            ////////////

            echo "action or controller or model  NotFound";

            header("HTTP/1.0 404 Not Found");

            require ROOT .
                    'back_end' . D_S .
                    'app' . D_S .
                    'views' . D_S .
                    'templete' . D_S .
                    '404.php';
            exit();
        }
    }

    protected function charge_page($variable) {
        if (is_array($variable)) {
            extract($variable);
        }

        $page = $this->name . D_S . $this->action;

        $chemin = ROOT .
                'back_end' . D_S .
                'app' . D_S .
                'views' . D_S .
                'pages_web' . D_S .
                'MANUAL' . D_S .
                $page . '.php';

        if (is_file($chemin)) {
            require $chemin;
        } else {
            $page = $this->action;
            $chemin = ROOT .
                    'back_end' . D_S .
                    'app' . D_S .
                    'views' . D_S .
                    'pages_web' . D_S .
                    'DEFAULT' . D_S .
                    $page . '.php';

            require $chemin;
        }
    }

}
