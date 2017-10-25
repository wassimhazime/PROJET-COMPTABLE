<?php

namespace app\controller;


class controller_paiement extends startCONTROLLER{
    
    

        
    
     public function index($att=null) {
        
         
        
         $title = $this->html->getTitle($this->title);
          $info = $this->show();
         $table=$this->show();
         $this->render(compact('title','info','table'));
         
     }
     
    
     
     
     
     public function add($att=null) {
           
        
         $title = $this->html->getTitle($this->title).'relation';
         
     
        // $formEnfant[]=$this->formEnfant('avoir', 4);
         $form= $this->getFormHTML('');
         
            if(isset($_POST) && !empty($_POST)){
             $this->model->setData($_POST);
         }
         
         
         
         $this->render(compact('title','form'));
         
     }
     
     
     
     
}
