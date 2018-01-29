<?php

namespace app\module_achat\Controller\MANUAL;
use app\module_achat\Controller\Controller_DEFAULT;
use core\INTENT\Intent;

class Controller_paiement extends Controller_DEFAULT {
    
    protected function show(array $mode = Intent::MODE_SELECT_MASTER_MASTER, $condition = 1) {
        return parent::show($mode, $condition);
    }

    

}
