<?php

namespace core\notify\outilsnotify;

use \SplObserver;
use \SplSubject;

class mail implements SplObserver
{

    protected $mail='wassim.hazime@gmail.com';

//    public function __construct() {
//        if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail)) {
//            $this->mail = $mail;
//        }
//    }

    public function update(SplSubject $obj)
    {
//        var_dump($this->mail,
//                'Erreur détectée !', 
//                'Une erreur a été détectée sur le site. Voici les informations de celle-ci : ' . "\n". $obj->getFormation()) ;
    }
}
