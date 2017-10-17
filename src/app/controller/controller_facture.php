<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_facture extends startCONTROLLER{
    
    

     public function index($att=null) {
        
            if(isset($_POST) && !empty($_POST)){
             $this->model->setData($_POST);
         }
         
         $title = $this->html->getTitle($this->title);
            $info = $this->show();
         $table=$this->show();
         $this->render(compact('title','info','table'));
         
     }
       public function add($att=null) {
           if(isset($_POST) && !empty($_POST)){
             $this->model->setData($_POST);
         } 
         
         $title = $this->html->getTitle($this->title).'relation';
         
         $formEnfant[]= $this->formEnfant('bl', 3);
         $form= $this->getFormHTML($formEnfant);
         
         if (isset($_POST['ajout_data'])) {
            $data=$_POST;
           $id = $this->model->setData($data,['bl']);
          
        } 
       $this->render(compact('title','form'));
         
     }
    
     
     
     
}
