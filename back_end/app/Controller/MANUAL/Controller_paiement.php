<?php

namespace app\Controller\MANUAL;
use app\Controller\Controller_DEFAULT;
use core\INTENT\Intent;

class Controller_paiement extends Controller_DEFAULT {
    
    protected function show(array $mode = Intent::MODE_SELECT_MASTER_MASTER, $condition = 1) {
        return parent::show($mode, $condition);
    }

    

}
