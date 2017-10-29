<?php

namespace app\controller\MANUAL;
use app\controller\Controller_DEFAULT;

class controller_avoir extends Controller_DEFAULT {

      public function index($att = null) {



        $title = $this->name;
        $info = $this->show();
        $table = $this->show();

        $this->render(compact('title', 'info', 'table'));
    }

      public function add($att = null) {

     $title = $this->name;

     $form = $this->getFormHTML('');
      if (isset($_POST['ajout_data'])) {
            $data = $_POST;
            $id = $this->setData($data);
        }




        $this->render(compact('title', 'form'));
    }

}
