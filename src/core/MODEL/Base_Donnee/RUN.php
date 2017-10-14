<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\model\base_donnee;
use core\model\entitys\Entitys;

use \PDO;
use \PDOException;
use core\model\base_donnee\database;
use core\model\Entitys\EntitysSchema;
use core\notify\notify;

/**
 * Description of RUN
 *
 * @author Wassim Hazime
 */
class RUN {
    public $db;
    public $schema;
    public $entity;
  
     public function __construct(Entitys $entity ,EntitysSchema $schema=null) {
        $this->db = database::getDB();
        $this->schema = $schema;
        $this->entity = $entity;
    }
    
    
    public function run($sql, $select = true) {

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
            notify::send_Notify($exc->getMessage());
        }
    }
}
