<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_facture extends startCONTROLLER{
    
    

     public function index($att=null) {
        
           
         
         $title = $this->html->getTitle($this->title);
         $info = $this->getInfo($att);
         $enfantTable=['bl'];
         $enfantSelect=['id,N,raison_sociale'];
         $pereSelect=null;//'id_facture,N_facture,raison_sociale_facture';
         $select=['id','N'
             ,['raison_sociale'=>'raison_sociale'],
              ['bl'=>['id','N']]
         ] ;
         
         $table=$this->getTableHTMLrelation($enfantTable,$enfantSelect,$pereSelect);
        
         $this->render(compact('title','info','table'));
         
     }
       public function add($att=null) {
           
         
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
