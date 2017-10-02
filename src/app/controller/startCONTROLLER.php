<?php


namespace app\controller;
use core\Controller\controller;


class startCONTROLLER extends controller{
    
    protected $model;
    protected $html;
    protected $title;
    protected $nom;
    
    
    
    function __construct(string $url,string $nom) {
        parent::__construct($url);
        
        $this->nom=$nom;
        if($nom!='index'){
        $this->cahrge_liaison( $nom);}
    }
    
    protected function cahrge_liaison(string $model,string $html='default'){
            $this->title=$model;
           $_model= '\\app\\model\\model_'. $model ; 
           $_html='\\app\\html\\html_'. $html; 
           $this->model=new $_model();
           $this->html=new $_html();
    }
    
    
    
     protected function getInfo($condition, $link='',$select='*') {
        
         $data= $this->model->getData($condition,$link,$select);
        
         return $this->html->getInfo($data);
    } 
     protected function getTableHTML( $select, $link="reche") {
       $data= $this->model->getTableSQL($select);
        return $this->html->createTableHTML($data, $link);
        
    } 
     protected function getTableHTMLrelation( $enfantTable,$enfantSelect,$pereSelect, $link="reche") {
              
         $data =  $this->model->getTableSQLrelation($enfantTable,$enfantSelect,$pereSelect);
         
        
         
         return $this->html->createTableHTMLrelation($data, $link,$enfantTable);
        
    } 
    
    
    
    
    
    
    
    
    
     public function formEnfant($enfant,$index) {
     
         
         $dataEnfant= $this->model->getTableSQL_Orphelin(null,$this->nom,$enfant);
         $Enfant['data']= $this->html->multiselect($dataEnfant,$enfant);
         $Enfant['index']= $index;
       return $Enfant;
     }

     protected function getFormHTML($enfant=null,$index=0) {
          
          $metaFORM= $this->model->getMetaFORM(); // object meta
          
        
         return $this->html->getFormHTML($metaFORM,$enfant,$index) ;
         
    }
    
}
