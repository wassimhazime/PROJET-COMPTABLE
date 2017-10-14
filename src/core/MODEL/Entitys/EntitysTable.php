<?php

namespace core\model\entitys;
use core\routeur\Session;

class EntitysTable extends Entitys{
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
        return "'".str_replace(' ', '+', $value)."'";
    }
   
       public function gethref($key,$link) {
           
        return  Session::get('url') . $key . '=' .$this->getValueSyntaxeSql($key) . '';
      }
      
      
  public function  toJson(){
      return  json_encode((array)$this);
      
  }

}
