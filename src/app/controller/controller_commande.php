<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_commande extends startCONTROLLER{
    
    
    
   
     
     public function index($att=null) {
           
      if(isset($_POST) && !empty($_POST)){
             $this->model->setData($_POST);
         }
     
         
         $title = $this->html->getTitle($this->title);
         $info = $this->show();
         $table=$this->show();
         $form= $this->getFormHTML('');
         $this->render(compact('title','info','table','form'));
         
     }

   
}
