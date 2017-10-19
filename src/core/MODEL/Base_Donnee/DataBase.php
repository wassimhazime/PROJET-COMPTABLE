<?php

namespace core\MODEL\Base_Donnee;

use \PDO;
use \Exception;
use core\notify\notify;
use core\MODEL\Base_Donnee\Config;

class DataBase {

    private static $dbConnection = null;

    public static function getDB(array $config) {

        if (self::$dbConnection === null) {
            $DB = $config['DB'];
            $dbhost = $config['dbhost'];
            $dbuser = $config['dbuser'];
            $dbpass = $config['dbpass'];
            $dbname = $config['dbname'];


            try {
                $dbConnection = new PDO("$DB:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) {

                Notify::send_Notify($e->getMessage());

                die('Erreur data base: ' . $e->getMessage());
            }
            self::$dbConnection = $dbConnection;
        }

        return self::$dbConnection;
    }

}
