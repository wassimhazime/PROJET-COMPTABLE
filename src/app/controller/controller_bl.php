<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_bl extends startCONTROLLER{
    
    
      public function index($att=null) {
        
           
         
         $title = $this->html->getTitle($this->title);
         $info = $this->getInfo($att);
         $enfantTable=['commande'];
         $pereSelect=null;//'id_facture,N_facture,raison_sociale_facture';
         $enfantSelect=['id_commande,objectif_commande,raison_sociale_commande,date_commande']; 
         
         $table=$this->getTableHTMLrelation($enfantTable,$enfantSelect,$pereSelect);
        
         $this->render(compact('title','info','table'));
         
     }
       public function add($att=null) {
           
         
         $title = $this->html->getTitle($this->title).'relation';
         
         $formEnfant[]= $this->formEnfant('commande', 3);
         $form= $this->getFormHTML($formEnfant);
         
         if (isset($_POST['ajout_data'])) {
            $data=$_POST;
           $id = $this->model->setData($data,['commande']);
          
        } 
       $this->render(compact('title','form'));
         
     }

   
}
