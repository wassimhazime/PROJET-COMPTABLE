<?php

namespace app\controller;

class controller_commande extends startCONTROLLER {

    public function index($att = null) {

        if (isset($_POST['ajout_data'])) {
            $data = $_POST;
            $id = $this->model->setData($data);
        }


        $title = $this->html->getTitle($this->title);
        $info = $this->show();
        $table = $this->show();
        $form = $this->getFormHTML('');
        $this->render(compact('title', 'info', 'table', 'form'));
    }

}
