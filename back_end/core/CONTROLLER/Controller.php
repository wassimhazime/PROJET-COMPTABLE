<?php

namespace core\CONTROLLER;

class Controller {

    /** Action à réaliser */
    protected $route;
    protected $name;

    function __construct($route) {
        $this->route = $route;
        $this->name = $route['controleur'];
    }

       public static function executer($route) {
        $nomcontroller = $route['controleur'];
        $action = $route['action'];
        $param = $route['param'];

        $controllerFile = D_S.'app'.D_S.'controller'.D_S.'MANUAL'.D_S.'controller_' . $nomcontroller;

        if (is_file(ROOT . 'back_end' . $controllerFile . '.php')) {

        } else {
            $controllerFile = D_S.'app'.D_S.'controller'.D_S.'Controller_DEFAULT' ;
            
        }
        
        
        
                    // si server window 
             $controller= str_replace("/", "\\", $controllerFile);
             $obController = new $controller($route);
            if (is_callable(array($obController, $action))) {
                
                call_user_func(array($obController, $action), $param);
                
            } else {self::NotFound("action  <b> $action </b>  not found");}
        
        
    }

    
    
    
    
    
    
    
    
    
       public static function NotFound($msg = 'not found') {
        echo $msg;
        header("HTTP/1.0 404 Not Found");
       
        require ROOT .
                'back_end' . D_S .
                'app' . D_S .
                'views' . D_S .
                '404.php';
    }


      

}
