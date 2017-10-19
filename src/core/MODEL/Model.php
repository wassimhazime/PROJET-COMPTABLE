<?php

namespace core\MODEL;


use core\INTENT\Intent;
use core\MODEL\Statement\Statement;
use core\MODEL\Outils\Schema;
use core\MODEL\Outils\Form;

class Model {

    public $EntitysTable;
    private $statement;
    private $table;
    private $schema;

    public function __construct($table) {
        $this->schema = Schema::getschema($table);
        $this->table = $table;
        $this->statement = new Statement($this->schema);
    }

    public function setData($data){
        if(isset($data) && !empty($data)){
            unset($data["ajout_data"]);
       $intent= Intent::parse($data,$this->schema);
        
        $this->statement->insert($intent);
        
        }
    }


    
    
    
    public function show(array $mode = Intent::MODE_SELECT_MASTER, $condition = 1) :Intent{

        
       
        $intent = $this->statement->Select($mode, $condition);
       
      
        return $intent;
    }

    public function getMetaFORM() {

        return Form::getForm($this->schema);
    }

}
