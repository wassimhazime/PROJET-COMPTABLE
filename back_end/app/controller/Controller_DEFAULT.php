<?php

namespace app\controller;

use core\CONTROLLER\Controller;

class Controller_DEFAULT extends Controller {

    /// default action

    public function index($att = null) {
        $title = $this->name;
        if ($this->name != 'index') {
            
            $info = $this->show();
            $table = $this->show();
            $this->render(compact('title', 'info', 'table'));
        } else {
            
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
    protected function render(array $variable = []) {

        ob_start();

        $this->charge_page($variable);
        $container = ob_get_clean();
        require ROOT .
                'back_end' . D_S .
                'app' . D_S .
                'views' . D_S .
                'templete' . D_S .
                'themes.php';
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
