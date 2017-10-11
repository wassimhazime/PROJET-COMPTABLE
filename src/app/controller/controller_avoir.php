<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_avoir extends startCONTROLLER{
    
    
    
  
    
     
     public function index($att=null) {
        
           
    
         $title = $this->html->getTitle($this->title);
         $info = $this->getInfo($att);
         $enfantTable=array('bl');
         $pereSelect=null;
         $enfantSelect=array('id,N,raison_sociale');
         
         $table=$this->getTableHTMLrelation($enfantTable,$enfantSelect,$pereSelect);
        
         $this->render(compact('title','info','table'));
         
     }
     
    
     
     public function add($att=null) {
           
         
         $title = $this->html->getTitle($this->title).'relation';
        
         
         
        // $formEnfant[]= $this->formEnfant('facture', 3);
         $formEnfant[]=$this->formEnfant('bl', 4);
         
         
         
         $form= $this->getFormHTML($formEnfant,0);
         
         
         
         
   
      
         if (isset($_POST['ajout_data'])) {
            $data=$_POST;
            $enfant=['facture','bl'];
            $id = $this->model->setData($data,$enfant);
          
        }
         
         
         
         
         
         $this->render(compact('title','form'));
         
     }
     
     
}
