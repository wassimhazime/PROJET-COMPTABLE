<?php

namespace app\controller;

use core\CONTROLLER\Controller;
use core\html\TAG;
use core\INTENT\Intent;

class Controller_DEFAULT extends Controller {

    protected $model ;
    protected $route;
    protected $name;

    function __construct($route) {
        $this->route = $route;
        $this->name = $route['controleur'];
    
        
        if ($route['controleur'] != 'index') {
            $this->setModel($route['controleur']);
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
         header("Location: ".ROOTWEB.$this->name); 
    }
    
    
    /// default action

      public function index($att = null) {
          if ($this->route['controleur'] != 'index') {
           $title = $this->name;
        $info = $this->show();
        $table = $this->show();
        $this->render(compact('title', 'info', 'table')); 
        } else {
        $title = "index";
        $info = "";
        $table = "";
        $this->render(compact('title', 'info', 'table'));   
        }

        
    }

      public function add($att = null) {
        if (isset($_POST['ajout_data'])) {
            $data = $_POST;
            $id = $this->setData($data);
        }
        $title = $this->name;
        $form = $this->getFormHTML();
        
        $this->render(compact('title', 'form'));
    }
    
/// show view
       protected function render(array $variable=[]) {

        ob_start();

        $this->charge_page( $variable);
        $container = ob_get_clean();
        require ROOT .
                'back_end' . D_S .
                'app' . D_S .
                'views' . D_S .
                'templete' . D_S .
                'themes.php';
    }
       protected function charge_page( $variable) {
           if (is_array($variable)) {
            extract($variable);
        }

     $page = $this->route['controleur'].D_S.$this->route['action'];
        
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
         $page = $this->route['action'];   
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
