<?php
namespace core\routeur;


class Session
{

   
 

    public static function destroy()
    {
        session_destroy();
    }


    public static function set($nom, $valeur)
    {
        $_SESSION[$nom] = $valeur;
    }

    
    public static function has($nom)
    {
        return (isset($_SESSION[$nom]) && $_SESSION[$nom] != "");
    }

   
    public static function get($nom)
    {
        if (self::has($nom)) {
            return $_SESSION[$nom];
        }
        else {
            throw new Exception("Attribut '$nom' absent de la session");
        }
    }

}