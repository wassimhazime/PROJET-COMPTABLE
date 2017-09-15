<?php

namespace core\model\entitys;

class entity {
    private $enfant=array();
  
           
    function __construct() {
        
    }
    
//add item enfant

    public function setEnfant($key,$enfant){
        $this->enfant[$key]=$enfant;
    }
    public function getEnfant($key){
        return $this->enfant[$key];
    }
 
    
    
    
        public function getArray() {
        return (array) $this;
        }
    
    public function getValueSyntaxeSql($key) {
        
        $value =$this->$key;
        return str_replace(' ', '+', $value);
    }
   
       public function gethref($key,$link) {
        return $_SESSION['url'] . $link . ':' . $key . '=' .$this->getValueSyntaxeSql($key) . '';
      }
      public function __toString() {
          echo  'P';  
          return 'kkk';
      }


}
