<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\html;
use core\INTENT\Intent;
use core\html\element\TableHTML;

/**
 * Description of TAG
 *
 * @author Wassim Hazime
 */
class TAG {
    public function tableHTML(Intent $intent) {
        $tablehtml=new TableHTML();
        return $tablehtml->parse($intent);
        
        
    }
    
}
