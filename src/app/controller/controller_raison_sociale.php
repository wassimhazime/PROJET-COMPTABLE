<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_raison_sociale extends startCONTROLLER{
    
   
    
     public function index($att=null) {
      
     
         
         $title = $this->html->getTitle($this->title);

        if (isset($_POST['ajout_data'])) {
            $data=$_POST;
           $id = $this->model->setData($data);
           $info = $this->getInfo($id);
        } else {
            
            $info = $this->getInfo($att);
        }
       
         $table=$this->getTableHTML(null,'recherche');
         $form= $this->getFormHTML('');
         $this->render(compact('title','info','table','form'));
         
     }
     
}
