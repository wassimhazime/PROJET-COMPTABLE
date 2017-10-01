<?php

namespace core\Controller;

class  controller {

    /** Action à réaliser */
    protected $url;
    protected $action;
    function __construct($url,$nom=null) {
        $this->url = $url;
    }
    
    
    

    public static function executer($parst) {
        $nomcontroller = $parst['controleur'];
        $action = $parst['action'];
        $param = $parst['param'];
        
        $controller = '\\app\\controller\\controller_' . $nomcontroller;
        
        if (is_file(ROOT.$controller.'.php')or is_file(ROOT.'\\src'.$controller.'.php')) {
          $url=$nomcontroller.D_S.$action;  
          
          
        $controller= new $controller($url,$nomcontroller);  
        $controller->action = $action;
        
        $controller->{$controller->action}($param);
        } else {
           
             self::NotFound('controler not found');
        }
        }
    public function render( $variable = []) {
        
            $page=$this->url;
          $this->startTHEMES($page, $variable);  
       
        
    }
    public function __call($nom, $arguments) {
        $this->render($nom, $arguments);//action NotFound()  
    }
    
    private function startTHEMES($page, $variable) {

        ob_start();

        $this->charge_page($page, $variable);
        $container = ob_get_clean();
        require ROOT .
                'src' . D_S .
                'app' . D_S .
                'views' . D_S .
                'templete' . D_S .
                'themes.php';
    }
   
  
    private function charge_page($page, $variable) {
        
   
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
            
            self::NotFound('action not found');
        }
    }
    
    
    public static function NotFound($msg='not found') {
        echo $msg;
        header("HTTP/1.0 404 Not Found");
        // header("Location: http://www.example.com/");
        require ROOT .
                'src' . D_S .
                'app' . D_S .
                'views' . D_S .
                '404.php';
    }

}
