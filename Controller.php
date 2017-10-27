<?php

namespace core\CONTROLLER;

class Controller {

    /** Action à réaliser */
    protected $route;

    function __construct($route) {
        $this->route = $route;
    }

    public static function executer($route) {
        $nomcontroller = $route['controleur'];
        $action = $route['action'];
        $param = $route['param'];

        $controller = '\\app\\controller\\controller_' . $nomcontroller;

        if (is_file(ROOT . '\\src' . $controller . '.php')) {
            
            $obController = new $controller($route);
            if (is_callable(array($obController, $action))) {
                
                call_user_func(array($obController, $action), $param);
                
            } else {self::NotFound("action  <b> $action </b>  not found");}
        } else {self::NotFound("controler  <b> $nomcontroller</b> not found");}
    }


    public function render($variable = []) {

        
        
        $this->startTHEMES($variable);
    }

    private function startTHEMES( $variable) {

        ob_start();

        $this->charge_page( $variable);
        $container = ob_get_clean();
        require ROOT .
                'src' . D_S .
                'app' . D_S .
                'views' . D_S .
                'templete' . D_S .
                'themes.php';
    }

    private function charge_page( $variable) {

$page = $this->route['controleur'].D_S.$this->route['action'];
        if (is_array($variable)) {
            extract($variable);
        }
        $chemin = ROOT .
                'src' . D_S .
                'app' . D_S .
                'views' . D_S .
                'pages_web' . D_S .
                $page . '.php';

        if (is_file($chemin)) {

            require $chemin;
        } else {

            self::NotFound("erreur chemin page $chemin ");
        }
    }

    
    
    
    
    
    public static function NotFound($msg = 'not found') {
        echo $msg;
        header("HTTP/1.0 404 Not Found");
       
        require ROOT .
                'src' . D_S .
                'app' . D_S .
                'views' . D_S .
                '404.php';
    }

}
