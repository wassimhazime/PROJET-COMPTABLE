<?php


namespace app\controller;
use core\Controller\controller;
use core\html\TAG;
use core\INTENT\Intent;

class startCONTROLLER extends controller{
    
    protected $model;
    protected $html;
    protected $title;
    protected $nom;
    
    
    
    function __construct($route) {
        parent::__construct($route);
        
        $this->nom=$route['controleur'];
        if($route['controleur']!='index'){
        $this->charge_liaison( $route['controleur']);
         }
    }
    
    protected function charge_liaison(string $model,string $html='default'){
            $this->title=$model;
           $_model= '\\app\\model\\model_'. $model ; 
           $_html='\\app\\html\\html_'. $html; 
           $this->model=new $_model();
           $this->html=new $_html();
    }
    
    
    
  
     protected function show(int $mode = Intent::MODE_SELECT_MASTER, $condition = 1 ) {
        $intent= $this->model->show($mode,$condition);
        return (new TAG())->tableHTML($intent);
} 
     
    
    
    
    
    
    
    
    
    


     protected function getFormHTML($enfant=null,$index=0) {
          
        $metaFORM= $this->model->getMetaFORM(); // object meta
      
         return $this->html->getFormHTML($metaFORM,$enfant,$index) ;
         
    }
    
}
