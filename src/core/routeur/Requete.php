<?php
namespace core\routeur;
use core\routeur\Session;

class Requete
{
   
 private $parametre=[];
 

   
    public function __construct()
    {
        $this->parametres['GET'] = $_GET;
        $this->parametres['POST'] = $_POST;
        
        
    }
    
    public function getURL(){
        
        return ROOTWEB.$this->getParametreGET('controleur').'/'.$this->getParametreGET('action').'/';
    }
    
   

    private function existeParametreGET($nom)
    {
        return (isset($this->parametres['GET'][$nom]) && $this->parametres['GET'][$nom]!= "");
     
    }

    
    
    
    
    
   
    public function getParametreGET($nom,$isnull='')
    {
        if ($this->existeParametreGET($nom)) {
        return $this->parametres['GET'][$nom];
        } else {
            return $isnull;
        }

    }

}

