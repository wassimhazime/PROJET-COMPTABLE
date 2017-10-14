<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\MODEL\Outils;
use core\model\Entitys\EntitysTable;

use \PDO;
use \PDOException;
use core\model\base_donnee\database;
use core\notify\notify;
class Autocomplete {
     private $db, $entity;
    
    
   function __construct() {
        $this->db = database::getDB();
        $this->entity = new EntitysTable();
    }
    
    public static function getAutocomplete($table) {
        $describe = (new self)->run("SHOW COLUMNS FROM " .
                $table.
                " WHERE `null`='no' and "
                . "`Type` !='varchar(201)' and"
                . " `Type` !='varchar(20)' and "
                . "`Key`!='MUL' "
                );
        $select = [];

        foreach ($describe as $champ) {
       $select[] = $champ->Field;
        }
        
        $colums= implode(' , ', $select); 
        
        
     return (new self)->run('SELECT ' .$colums. ' FROM '.$table);
    }
    
  
     private function run($sql, $select = true) {

        try {
            if ($select) {
                $Statement = $this->db->query($sql);


                $Statement->setFetchMode(PDO::FETCH_CLASS, get_class($this->entity));


                return $Statement->fetchAll();
            } else {
                $this->db->exec($sql);
                return $this->db->lastInsertId();
            }
        } catch (PDOException $exc) {
            notify::send_Notify($exc->getMessage()."   ".$sql);
        }
    }
    
}
