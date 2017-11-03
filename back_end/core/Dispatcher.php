<?php

namespace core;

use core\Router\Router;
use core\CONTROLLER\Controller;

class Dispatcher {

    public static function load() {

        $app = new Router();


        $app->get("/comptable/{Controleur}/{Action}", function ($C, $A) {
            $route = [];
            $route['controleur'] = $C;
            $route['action'] = $A;
            $route['param'] = "";
            Controller::executer($route);
        });

        $app->get("/comptable/{Controleur}", function ($C) {
            $route = [];
            $route['controleur'] = $C;
            $route['action'] = "index";
            $route['param'] = "";
            Controller::executer($route);
        });

        $app->get("/comptable/", function () {
            $route = [];
            $route['controleur'] = "index";
            $route['action'] = "index";
            $route['param'] = "";
            Controller::executer($route);
        });

        
        
        

        $app->run();
    }

}
