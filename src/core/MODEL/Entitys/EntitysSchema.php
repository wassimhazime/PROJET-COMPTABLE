<?php

namespace core\MODEL\Entitys;

class EntitysSchema extends Entitys {
    private $modeCHILDREN=null;

    private $PARENT = "";
    private $COLUMNS_master = ["*"];
    private $COLUMNS_all = ["*"];
    private $FOREIGN_KEY = [];
    private $CHILDREN = [];
    

    function set(string $PARENT, array $COLUMNS_master = ["*"], array $COLUMNS_all = ["*"], array $FOREIGN_KEY = [], array $CHILDREN = []) {
        $this->PARENT = $PARENT;
        $this->COLUMNS_master = $COLUMNS_master;
        $this->COLUMNS_all = $COLUMNS_all;
        $this->FOREIGN_KEY = $FOREIGN_KEY;
        $this->CHILDREN = $CHILDREN;
        
    }
    public function Instance(array $table):self {
        $this->PARENT = $table["PARENT"];
       $this->COLUMNS_master = $table["COLUMNS_master"];
        $this->COLUMNS_all = $table["COLUMNS_all"];
        $this->FOREIGN_KEY = $table["FOREIGN_KEY"];
        $this->CHILDREN = $table["CHILDREN"];
        
        return $this;
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

    function getCHILDREN($mode=null) {
        $this->setModeCHILDREN($mode);
     
        return $this->CHILDREN[$this->modeCHILDREN];
    }
    function get_table_CHILDREN($mode=null) {
        $this->setModeCHILDREN($mode);
       $TABLE=[];
       foreach ($this->CHILDREN[$this->modeCHILDREN] as $table => $columns) {
          $TABLE[]=$table; 
       }
       
        return $TABLE;
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

        $select = [];
        foreach ($this->COLUMNS_master as $colom) {
            $select[] = $this->PARENT . "." . $colom;
        }
        foreach ($this->FOREIGN_KEY as $FOREIGN) {
            $select[] = $FOREIGN . "." . $FOREIGN;
        }
        return $select;
    }
    
    function select_all() {

        $select = [];
        foreach ($this->COLUMNS_all as $colom) {
            $select[] = $this->PARENT . "." . $colom;
        }
        foreach ($this->FOREIGN_KEY as $FOREIGN) {
            $select[] = $FOREIGN . "." . $FOREIGN;
        }
        return $select;
    }
    
    private function setModeCHILDREN($mode) {
        if($mode==null and $this->modeCHILDREN==null){
            $this->modeCHILDREN="MASTER";
         } elseif ($mode!=null) {
          $this->modeCHILDREN=$mode;   
         }
        
        
    }
    

    function select_CHILDREN($TABLE = null,$mode=null) {
        $this->setModeCHILDREN($mode);
        
        
         
       
        $select = [];

        if ($TABLE == null) {

            foreach ($this->CHILDREN[$this->modeCHILDREN] as $table => $colums) {

                foreach ($colums as $colum) {
                    $select[] = $table . "." . $colum . " as $table" . "_" . $colum;
                }
            }
        } else {
            
              foreach ($this->CHILDREN[$this->modeCHILDREN][$TABLE] as  $colum) {

                
                    $select[] = $TABLE . "." . $colum . " as $TABLE" . "_" . $colum;
                
            }
            
            
        }


        

        return $select;
    }

}
