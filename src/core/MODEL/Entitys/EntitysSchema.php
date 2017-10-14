<?php


namespace core\model\entitys;


class EntitysSchema extends Entitys {
    private $COLUMNS_master;
    private $COLUMNS_all;
    private $FOREIGN_KEY;
    private $CHILDREN;
    private $PARENT ;
     

    function getCOLUMNS_all() {
        return $this->COLUMNS_all;
    }

    function setCOLUMNS_all($COLUMNS_all) {
        $this->COLUMNS_all = $COLUMNS_all;
    }

    
    function getCOLUMNS_master() {
        return $this->COLUMNS_master;
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

    function setCOLUMNS_master($COLUMNS) {
        $this->COLUMNS_master = $COLUMNS;
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

    

 
    
    
    
     function get_select_CHILDREN() {
        return $this->CHILDREN;
    }

    function get_select_PARENT() {
        return $this->PARENT;
    }
    
    
    
    
}
