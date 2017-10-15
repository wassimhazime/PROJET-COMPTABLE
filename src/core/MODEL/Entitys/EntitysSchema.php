<?php


namespace core\model\entitys;


class EntitysSchema extends Entitys {
    private $COLUMNS_master=["*"];
    private $COLUMNS_all=["*"];
    private $FOREIGN_KEY=[];
    private $CHILDREN=[];
    private  $PARENT="" ;
     
    function set(string $PARENT,array $COLUMNS_master=["*"],array $COLUMNS_all=["*"],array $FOREIGN_KEY=[],array $CHILDREN=[] ) {
        $this->COLUMNS_master = $COLUMNS_master;
        $this->COLUMNS_all = $COLUMNS_all;
        $this->FOREIGN_KEY = $FOREIGN_KEY;
        $this->CHILDREN = $CHILDREN;
        $this->PARENT = $PARENT;
    }

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

    

 
    
    
    

   
    
    function select_master() {
        
        $select=[];
        foreach ($this->COLUMNS_master as $colom) {
          $select[]= $this->PARENT.".".$colom; 
        }
        foreach ($this->FOREIGN_KEY as $FOREIGN) {
            $select[]= $FOREIGN.".".$FOREIGN;
        }
        return $select;
    }
    function select_CHILDREN() {
        
        $select=[];
        
        foreach ($this->CHILDREN as $table => $colums) {
            
            foreach ($colums as $colum) {
              $select[]= $table.".".$colum ." as $table"."_".$colum;  
            }
            
        }
      
        return $select;
    }
    
}
