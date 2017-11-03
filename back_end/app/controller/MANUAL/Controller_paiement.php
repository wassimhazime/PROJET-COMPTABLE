<?php

namespace app\controller\MANUAL;
use app\controller\Controller_DEFAULT;
use core\INTENT\Intent;

class Controller_paiement extends Controller_DEFAULT {
    
    protected function show(array $mode = Intent::MODE_SELECT_MASTER_NULL, $condition = 1) {
        return parent::show($mode, $condition);
    }

    

}
