<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\html;
use core\INTENT\Intent;
use core\html\element\TableHTML;
use core\html\element\FormHTML;

/**
 * Description of TAG
 *
 *Les décorateurs
 */
class TAG {   

    
    public function tableHTML(Intent $intent) {
        $tablehtml=new TableHTML($intent);
        return $tablehtml->builder("class='table table-hover table-bordered' style='width:100%'");
        
        
    }
    public function FormHTML(Intent $intent) {
        $formhtml=new FormHTML($intent);
        return $formhtml->builder("  ");
        
        
    }
}
