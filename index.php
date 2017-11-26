<?php
define('D_S'    , DIRECTORY_SEPARATOR);
define('ROOT'   , str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']) );
define('ROOTWEB', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

//test fedora

use core\Dispatcher;
use \Whoops\Run;
use \Whoops\Handler\PrettyPageHandler;


// autoload  de composer
require ROOT . 'vendor' . D_S . 'autoload.php'; 





/// Handler error
(new Run)
        ->pushHandler(new PrettyPageHandler)
        ->register();





// start application
$start= microtime(true);

Dispatcher::load();

$fin= round(microtime(true)-$start,5);

echo"<h5>". $fin.' secondes </h5>';
