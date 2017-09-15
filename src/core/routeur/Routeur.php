<?php
namespace core\routeur;



class Routeur
{

    

    static function parst($requete) {
      
        $controleur = self::getControleur($requete);
        $action = self::getAction($requete);
        $param = self::getparam($requete);
        $parst['controleur']=$controleur;
        $parst['action']=$action;
        $parst['param']=$param;
        
    
        return $parst;
    }

    
   

    private static function getControleur($requete,$default='index')
    {
      
    
         $controleur = $requete->getParametreGET('controleur',$default);
        
         
          return $controleur;
          
            
         
    }

    private static function getAction($requete,$default='index')
    {
       $action = $requete->getParametreGET('action',$default);
        return $action;
    }

    
    private static function getparam($requete,$default='vide-null=" "'){
       // echo '<br><br><br><br><br><br><br><br><br>';
        
        $param = $requete->getParametreGET('param',$default);
       
        $param=explode( '=',$param);
     
        
        return [$param[0]=>$param[1]] ;
    }

    
    
    
    
   
}
