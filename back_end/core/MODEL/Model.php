<?php

namespace core\MODEL;

use core\INTENT\Intent;
use core\MODEL\Statement\Statement;
use core\MODEL\Outils\Schema;

class Model {

    private $statement;

    public function __construct($table) {

        $this->statement = new Statement(Schema::getschema($table));
    }

    public function setData($data, $mode = Intent::MODE_INSERT): Intent {
        if (isset($data) && !empty($data)) {
            unset($data["ajout_data"]);
            $intent = $this->statement->insert($data, $mode);
            return $intent;
        } else {
            throw new \TypeError(" ERROR setData(data) model  ==> data null");
        }
    }

    public function show(array $mode = Intent::MODE_SELECT_MASTER_MASTER, $condition = 1): Intent {
       
        $intent = $this->statement->Select($mode, $condition);
        return $intent;
    }

    public function form(array $mode = Intent::MODE_FORM): Intent {
        $intent = $this->statement->form($mode);
        return $intent;
    }

}
