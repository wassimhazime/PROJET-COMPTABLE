<?php

namespace core\html;

// factory darori


use core\html\Bootstrap\Bootstrap;
use core\html\Bootstrap\DialogHTML;
use core\html\element\tableHTML\TableHTML;
use core\html\element\tableHTML\TableHTMLrelation;
use core\html\element\FormHTML;
use core\html\element\multiSelect;

class html {

    public $bootstrap;
    public $DialogHTML;
    public $TableHTML;
    
    public $FormHTML;
    public $multiSelect;
    public $TableHTMLrelation;
    public $page;
    public $suffixe;

    public function __construct($page) {
        $this->page = $page;

        $this->bootstrap = new Bootstrap();
        $this->DialogHTML = new DialogHTML();
         $this->multiSelect = new multiSelect();
        $this->TableHTML = new TableHTML();
        $this->TableHTMLrelation = new TableHTMLrelation();
        $this->FormHTML = new FormHTML();
        
    }

//    public static function page($page) {
//        return new html($page);
//    }
    
    public function multiselect($item,$filds, $param = '', $balis = 'option ') {
        
        return  $this->multiSelect->multiselect($item, $filds, $param, $balis) ;
    }
 public function getTitle($title) {
     $this->suffixe=$title;
         $title=  str_replace('_', ' ', $title);
        return '<div class="title"><h1><strong><center>'.ucfirst($title).'</center></strong></h1></div>';
    }

    public function createTableHTML($data, $link) {
    return $this->TableHTML->createTableHTML($data,$this->suffixe, $link);
    }
  
    public function createTableHTMLrelation($data, $link,$title) {
    return $this->TableHTMLrelation->createTableHTMLrelation($data,$this->suffixe, $link,$title);
    }
    public function getFormHTML($metaFORM,$formEnfant=null,$index=0) {
        return $this->FormHTML->createFormHTML($metaFORM,$formEnfant,$index);
    }

    public function getInfo($data) {


        if ($data == null) {
            return $this->bootstrap->createJumbotron("<h1>vide</h1>");
        } else {
            return  $this->Infocherche($data);
        }
    }



    public function Infocherche($data, $btn = 'test') {

        $content = $this->TableHTML->createTableHTML($data,$this->suffixe);

        $content = $this->bootstrap->createStyleTable($content);
        
        

        return  $this->bootstrap->createJumbotron($content, $btn) .'  '.$this->Infochercheplus($data, $btn);

        
    }

    public function Infochercheplus($data, $btn) {
        $content = $this->DialogHTML->getBodyDialog($data);

        return $this->bootstrap->createModal($content, $btn);
    }

}
