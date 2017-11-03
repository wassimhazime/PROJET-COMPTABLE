<?php

namespace core\CONTROLLER;

use core\html\TAG;
use core\INTENT\Intent;

class Controller {

    protected $model;
    protected $route;
    protected $name;

    function __construct($route) {
        $this->route = $route;
        $this->name = $route['controleur'];


        if ($route['controleur'] != 'index') {
            $this->setModel($route['controleur']);
        }
    }

    public static function executer($route) {
        $nomcontroller = $route['controleur'];
        $action = $route['action'];
        $param = $route['param'];

        $controllerFile = D_S . 'app' . D_S . 'controller' . D_S . 'MANUAL' . D_S . 'Controller_' . $nomcontroller;
 
        if (is_file(ROOT . 'back_end' . $controllerFile . '.php')) {
            
        } else {
            $controllerFile = D_S . 'app' . D_S . 'controller' . D_S . 'Controller_DEFAULT';
        }


       
        // si server window 
        $controller = str_replace("/", "\\", $controllerFile);
        $obController = new $controller($route);
        if (is_callable(array($obController, $action))) {

            call_user_func(array($obController, $action), $param);
        } else {
            self::NotFound("action  <b> $action </b>  not found");
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

            self::NotFound($exc->getMessage());
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
        // var_dump($intent);
        header("Location: " . ROOTWEB . $this->name);
    }

    public static function NotFound($msg = 'not found') {
        echo $msg;
        header("HTTP/1.0 404 Not Found");

        require ROOT .
                'back_end' . D_S .
                'app' . D_S .
                'views' . D_S .
                'templete' . D_S .
                '404.php';
    }

}
