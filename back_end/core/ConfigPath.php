<?php

namespace core;

class ConfigPath {
    const Path = ROOT  . "back_end" . D_S ;
    const PathApp = self::Path. "app" . D_S;
    const PathAppConfig = self::PathApp . "config" . D_S;
    const PathAppViews = self::PathApp . "views" . D_S;

    public static function getPath($name) {
        switch ($name) {
             case "back_end":
                return self::Path;
                break;
            case "app":
                return self::PathApp;
                break;
            case "config":
                return self::PathAppConfig;
                break;
            case "model":
                return self::PathAppConfig . "model" . D_S;
                break;
            case "html":
                return self::PathAppConfig . "html" . D_S;
                break;

            case "templeteROOT":
                return self::PathAppViews . 'templete' . D_S;
                break;
            case "views_MANUAL":
                return self::PathAppViews . 'views_page' . D_S . 'MANUAL' . D_S;
                break;
            case "views_DEFAULT":
                return self::PathAppViews . 'views_page' . D_S . 'DEFAULT' . D_S;
                break;
               default:
                return ROOT ;
                break;
        }
    }

}
