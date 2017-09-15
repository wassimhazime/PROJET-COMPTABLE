<?php
namespace core\model\base_donnee;

class  config{
    public $DB;
    public $dbhost ;
    public $dbuser ;
    public $dbpass ;
    public $dbname ;
    
    
     function __construct(   $DB='mysql',
                        $dbhost = "localhost",
                        $dbuser = "comptable", 
                        $dbpass = "achrafwassim", 
                        $dbname = "awacomptable") {
         
                            $this->DB = $DB;
                            $this->dbhost = $dbhost;
                            $this->dbuser = $dbuser;
                            $this->dbpass = $dbpass;
                            $this->dbname = $dbname;
        
    }
  
    
    
}
