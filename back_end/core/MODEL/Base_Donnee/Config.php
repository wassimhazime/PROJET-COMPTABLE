<?php

namespace core\MODEL\Base_Donnee;
use core\ConfigPath;

use core\notify\Notify;
use \Exception;

class Config extends ConfigPath{

   
    private static $connect = [];
    private static $SCHEMA_SELECT_AUTO;
    private static $SCHEMA_SELECT_MANUAL;
    public static function getPath() {
        return parent::getPath(). "model" . D_S;
    }

    public static function getConnect(string $path = null, string $name = null): array {
        try {
            if ($path == null) {
                $path = self::getPath();
            }
            if ($name == null) {
                $name = 'Connect_DataBase';
            }
            $file_connect = file_get_contents($path . $name . ".json");
            $config = json_decode($file_connect, true);
            $BOOT = $config['BOOT'];
            self::$connect["cache"] = $config[$BOOT]['$CACHE'];

            self::$connect["DB"] = $config[$BOOT]['$DB'];
            self::$connect["dbhost"] = $config[$BOOT]['$dbhost'];
            self::$connect["dbuser"] = $config[$BOOT]['$dbuser'];
            self::$connect["dbpass"] = $config[$BOOT]['$dbpass'];
            self::$connect["dbname"] = $config[$BOOT]['$dbname'];
        } catch (Exception $e) {

            Notify::send_Notify(" ERORR CONFIG JSON  class methode getConnect() config <br> file name ==> $name .json <br><h1> " . $e->getMessage() . "</h1>");
            die();
        }

        return self::$connect;
    }

    

    public static function getNameDataBase(): string {
        return self::getConnect()["dbname"];
    }

    

    public static function getSCHEMA_SELECT_MANUAL(string $path = null): array {
        if ($path == null) {
            $path = self::getPath();
        }


        try {
            $schemaMANUAL = file_get_contents($path . "2SCHEMA_SELECT_MANUAL.json");
            self::$SCHEMA_SELECT_MANUAL = json_decode($schemaMANUAL, true);

            return self::$SCHEMA_SELECT_MANUAL["MANUAL"];
        } catch (Exception $e) {

            Notify::send_Notify(' ERORR CONFIG model JSON  class config  getSCHEMA_SELECT_MANUAL() <br>' . $e->getMessage());
            return [];
        }
    }

    public static function getSCHEMA_SELECT_AUTO(string $path = null): array {
        if ($path == null) {
            $path = self::getPath();
        }
        try {
            $schemaAUTO = file_get_contents($path . "3SCHEMA_SELECT_AUTO.json");
            self::$SCHEMA_SELECT_AUTO = json_decode($schemaAUTO, true);
            return self::$SCHEMA_SELECT_AUTO["AUTO"];
        } catch (Exception $e) {

            Notify::send_Notify(' ERORR CONFIG model JSON  class config getSCHEMA_SELECT_AUTO <br>' . $e->getMessage());
            return [];
        }
    }

    public static function getgenerateCACHE_SELECT(string $path = null): array {


        if ($path == null) {
            $path = self::getPath();
        }
        try {
            $flageCache = self::getConnect()["cache"];
            if ($flageCache) {
                $schemaCACHE_SELECT = file_get_contents($path . "1generateCACHE_SELECT.json");
                $generateCACHE_SELECT = json_decode($schemaCACHE_SELECT, true);

                if (is_string($generateCACHE_SELECT)) {
                    return ['generateCACHE_SELECT'];
                }
                return $generateCACHE_SELECT;
            } else {
                //'Ignore generateCACHE_SELECT'
                if (!is_string(json_decode(file_get_contents($path . "1generateCACHE_SELECT.json")))) {
                    $fp = fopen($path . "1generateCACHE_SELECT.json", 'w');
                    fwrite($fp, json_encode('FILE_config Connect_DataBase.json ==>  CACHE: false '));
                    fclose($fp);
                }
                return [];
            }
        } catch (Exception $e) {

            Notify::send_Notify(' generate FILE CACHE_SELECT <br>');
            return ['generateCACHE_SELECT'];
        }
    }

}
