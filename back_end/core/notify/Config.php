<?php

namespace core\notify;

use core\notify\outilsnotify\archive;
use core\notify\outilsnotify\mail;

class Config
{

    private static $outisnotify;
    static function setOutisnotify($outisnotify)
    {
        self::$outisnotify = $outisnotify;
    }

    static function getOutilsnotify()
    {
        
        if (self::$outisnotify == null) {
            self::$outisnotify = [new archive, new mail];
        }
        return self::$outisnotify;
    }
}
