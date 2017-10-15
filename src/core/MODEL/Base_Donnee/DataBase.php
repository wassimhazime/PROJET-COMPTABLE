<?php

namespace core\MODEL\Base_Donnee;

use \PDO;
use \Exception;
use core\notify\notify;

class DataBase {

    private static $dbConnection = null;

    public static function getDB() {

        if (self::$dbConnection === null) {

            $config = new Config();

            try {
                $dbConnection = new PDO("$config->DB:host=$config->dbhost;dbname=$config->dbname", $config->dbuser, $config->dbpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) {
                
                notify::send_Notify($e->getMessage());

                die('Erreur data base: ' . $e->getMessage());
            }
            self::$dbConnection = $dbConnection;
        }

        return self::$dbConnection;
    }

}
