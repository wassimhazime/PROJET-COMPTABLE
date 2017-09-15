<?php
namespace core\routeur;
use core\routeur\Session;

/**
 * Classe modélisant une requête HTTP entrante.
 * 
 * @author Baptiste Pesquet
 */
class Requete
{
   
    private $parametre=[];
 private $session;

   
    public function __construct()
    {
        $this->parametres['GET'] = $_GET;
        $this->parametres['POST'] = $_POST;
        $this->session = new Session();
        $this->session->setAttribut('url', $this->getURL());
    }
    
    public function getURL(){
        
        return ROOTWEB.$this->getParametreGET('controleur').'/'.$this->getParametreGET('action').'/';
    }
    
    
    public function getSession()
    {
        return $this->session;
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

