<?php

namespace core\MODEL;

use core\INTENT\Intent;
use core\MODEL\Statement\Statement;
use core\MODEL\Outils\Schema;

class Model {

    private $statement=null;
    private $is_null=false;

    public function __construct($table) {
        $schema=Schema::getschema($table);
        
        if($schema->getPARENT()==null){
            $this->is_null=TRUE;
        }else{
            $this->statement = new Statement($schema); 
        }
        
       
    }

    public function setData($data, $mode ): Intent {
        if (isset($data) && !empty($data)) {
            unset($data["ajout_data"]);
            $intent = $this->statement->insert($data, $mode);
            
            return $intent;
        } else {
            throw new \TypeError(" ERROR setData(data) model  ==> data null");
        }
    }

    public function show(array $mode , $condition ): Intent {
       
        $intent = $this->statement->Select($mode, $condition);
        return $intent;
    }

    public function form(array $mode ): Intent {
        $intent = $this->statement->form($mode);
        return $intent;
    }
    function is_null() {
        return $this->is_null;
    }


}
