<?php

namespace core;



class ConfigPath {

    protected static $path;
    

    public static function getPath() {
        if (self::$path == null) {
            self::$path = ROOT . D_S . "src" . D_S . "app" . D_S . "config" . D_S. "model" . D_S;
        }
        return self::$path;
    }

   

    private function __construct(string $path = null) {
        if ($path == null) {
            self::getPath();
        } else {
            self::$path = $path;
        }
    }

    

}
