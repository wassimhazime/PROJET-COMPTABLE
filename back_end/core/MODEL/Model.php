<?php

namespace core\MODEL;

use core\INTENT\Intent;
use core\MODEL\Statement\Statement;
use core\MODEL\Outils\Schema;

class Model {

    private $statement;

    public function __construct($table) {
        $schema=Schema::getschema($table);
      
        if($schema->getPARENT()==null){
            throw new \TypeError(" ERROR not table  ==> table not in DATABASE");
        }
        $this->statement = new Statement($schema);
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

}
