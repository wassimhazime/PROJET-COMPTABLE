<?php
namespace core\reseau ;
use core\reseau\request;


class dispatcher {
    
   public $request;
   function __construct() {
       $this->request =new  request();
       echo $this->request->url;
   }

    
    
}