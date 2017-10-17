<?php

namespace app\controller;
use app\controller\startCONTROLLER;

class controller_raison_sociale extends startCONTROLLER{
    
   
    
     public function index($att=null) {
      
     
         
         $title = $this->html->getTitle($this->title);
         $info = $this->show();
         $table=$this->show();
         $form= $this->getFormHTML('');
         $this->render(compact('title','info','table','form'));
         
     }
     
}
