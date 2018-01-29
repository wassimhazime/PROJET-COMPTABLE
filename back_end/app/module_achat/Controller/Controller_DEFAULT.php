<?php

namespace app\module_achat\Controller;
           

use core\MVC\CONTROLLER\Controller;

class Controller_DEFAULT extends Controller {

    /// default action

    public function index($att = null) {
      
        $title = $this->name;
        if ($this->name != 'index' and !($this->model->is_null())) {
           $info = $this->show();
            $table = $this->show();
            return(compact('title', 'info', 'table'));
        } else {

            $info = "";
            $table = "";
            return(compact('title', 'info', 'table'));
        }
    }

    public function add($att = null) {
        if(($this->model->is_null())){
            return [];
        }
        if (isset($_POST['ajout_data']) ) {
            $data = $_POST;
            $id = $this->setData($data);
        }
        $title = $this->name;
        $form = $this->getFormHTML();

        return (compact('title', 'form'));
    }



}
