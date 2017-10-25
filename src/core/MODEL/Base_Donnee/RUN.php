<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\MODEL\Base_Donnee;

use core\MODEL\Entitys\abstractEntitys;
use \PDO;
use \PDOException;
use core\MODEL\Base_Donnee\DataBase;
use core\MODEL\Entitys\EntitysSchema;
use core\notify\Notify;
use core\MODEL\Base_Donnee\Config;

/**
 * Description of RUN
 *
 * @author Wassim Hazime
 */
class RUN {

    protected $schema;
    protected $schemaSELECT;
    protected $entity;

    public function __construct(abstractEntitys $entity, EntitysSchema $schema = null) {

        $this->schema = $schema;
        $this->entity = $entity;
    }

    public function query($sql): array {
        $db = DataBase::getDB(Config::getConnect());

        try {

            $Statement = $db->query($sql);

            $Statement->setFetchMode(PDO::FETCH_CLASS, get_class($this->entity));


            return $Statement->fetchAll();
        } catch (PDOException $exc) {
            Notify::send_Notify($exc->getMessage() . "querySQL  ERROR ==> </br> $sql");
            die();
        }
    }

    public function exec($sql): string {
        $db = DataBase::getDB(Config::getConnect());

        try {
            //$db->beginTransaction();
            $db->exec($sql);
            // $db->commit();

            return $db->lastInsertId();
        } catch (PDOException $exc) {
            // $db->rollBack();
            Notify::send_Notify($exc->getMessage() . "exec SQL ERROR ==> </br> $sql");
            die();
        }
    }

    // TOOLS

    public static function parse_object_TO_array($object): array {
        if (is_array($object)) {
            return $object;
        }
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }
    public static function entitys_TO_array($object): array {
        if (is_array($object)) {
            return $object;
        }
        $array = [];
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }
    public static function json_fileOUT(array $shema,string $path) {
       
        $fp = fopen($path."1generateCACHE_SELECT.json", 'w');
        fwrite($fp, json_encode( $shema));
        fclose($fp);
    }

}
