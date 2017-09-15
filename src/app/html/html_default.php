<?php
namespace app\html;
use core\html\html;

class html_default extends html{
    
    function __construct() {
        parent::__construct(trim(get_class(),__NAMESPACE__.'html'));
         
    }
    
   
}