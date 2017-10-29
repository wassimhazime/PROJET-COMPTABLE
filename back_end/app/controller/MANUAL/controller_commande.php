<?php

namespace app\controller\MANUAL;
use app\controller\Controller_DEFAULT;

class controller_commande extends Controller_DEFAULT {

    public function index($att = null) {

      if (isset($_POST['ajout_data'])) {
            $data = $_POST;
            $id = $this->setData($data);
        }


        $title = $this->name;
        $info = $this->show();
        $table = $this->show();
        $form = $this->getFormHTML('');
        $this->render(compact('title', 'info', 'table', 'form'));
    }

}
