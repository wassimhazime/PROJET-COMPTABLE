<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_paiement extends startCONTROLLER{
    
    

        
    
     public function index($att=null) {
        
           
        
         $title = $this->html->getTitle($this->title);
          $info = $this->show();
         $table=$this->show();
         $this->render(compact('title','info','table'));
         
     }
     
    
     
     
     
     public function add($att=null) {
           
        
         $title = $this->html->getTitle($this->title).'relation';
         
         $formEnfant[]= $this->formEnfant('facture', 3);
        // $formEnfant[]=$this->formEnfant('avoir', 4);
         $form= $this->getFormHTML($formEnfant,0);
         
          if (isset($_POST['ajout_data'])) {
            $data=$_POST;
            $enfant=['facture'];
            $id = $this->model->setData($data,$enfant);
          
        } 
         
         
         
         $this->render(compact('title','form'));
         
     }
     
     
     
     
}
