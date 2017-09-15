<?php

namespace core\notify;

use \SplObserver;
use \SplSubject;
use core\notify\config;

class notify implements SplSubject {

    function __construct(array $config=null) {
        if ($config === null) {
            $config = config::getOutilsnotify();
        }
        foreach ($config as $outil) {
            $this->attach($outil);
        }
    }

    static function send_Notify($msg, $config = null) {
        if ($config === null) {
            $config = config::getOutilsnotify();
        }
        $notify = new notify($config);

        $notify->setFormation($msg);
    }

    public $outilsnotify = [];
    private $Formation;

    public function attach(SplObserver $outilsnotify) {
        $this->outilsnotify[] = $outilsnotify;
        return $this;
    }

    public function detach(SplObserver $outilsnotify) {
        if (is_int($key = array_search($outilsnotify, $this->outilsnotify, true))) {
            unset($this->outilsnotify[$key]);
        }
    }

    public function notify() {
        foreach ($this->outilsnotify as $observer) {
            $observer->update($this);
        }
    }

    function getFormation() {
        return $this->Formation;
    }

    function setFormation($Formation) {
        $this->Formation = $Formation;
        $this->notify();
    }

}
