<?php


namespace core\model\entitys;


class EntitysSchema {
    public $COLUMNS=[];
    public $FOREIGN_KEY;
    public $CHILDREN;
    public $PARENT ;
     



    function getCOLUMNS() {
        return $this->COLUMNS;
    }

    function getFOREIGN_KEY() {
        return $this->FOREIGN_KEY;
    }

    function getCHILDREN() {
        return $this->CHILDREN;
    }

    function getPARENT() {
        return $this->PARENT;
    }

    function setCOLUMNS($COLUMNS) {
        $this->COLUMNS = $COLUMNS;
    }

    function setFOREIGN_KEY($FOREIGN_KEY) {
        $this->FOREIGN_KEY = $FOREIGN_KEY;
    }

    function setCHILDREN($CHILDREN) {
        $this->CHILDREN = $CHILDREN;
    }

    function setPARENT($PARENT) {
        $this->PARENT = $PARENT;
    }

    

     public function addColumns($columns) {
        $this->COLUMNS[]= $columns;
    }
     public function addFOREIGN_KEY($FOREIGN_KEY) {
        $this->FOREIGN_KEY[]= $FOREIGN_KEY;
    }
    
    public function addTables_CHILDREN($CHILDREN) {
        $this->CHILDREN[]= $CHILDREN;
    }
    
    
    
     function get_select_CHILDREN() {
        return $this->CHILDREN;
    }

    function get_select_PARENT() {
        return $this->PARENT;
    }
    
    
    
    
}
