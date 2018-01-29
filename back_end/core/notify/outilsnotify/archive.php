<?php

namespace core\notify\outilsnotify;

use \SplObserver;
use \SplSubject;

class archive implements SplObserver
{

    public $db;
    function __construct()
    {
        $this->db= 'databass';
    }

    public function update(SplSubject $news)
    {
        echo 'archive   : firask achno jra  ==>' . $news->getFormation();
    }
}
