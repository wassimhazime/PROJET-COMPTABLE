<?php

namespace app\controller;


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
         
         $form= $this->getFormHTML('');
         
         if (isset($_POST['ajout_data'])) {
            $data=$_POST;
           $id = $this->model->setData($data,['bl']);
          
        } 
       $this->render(compact('title','form'));
         
     }
    
     
     
     
}
