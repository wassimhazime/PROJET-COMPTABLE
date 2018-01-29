<?php

define('D_S', DIRECTORY_SEPARATOR);
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('ROOTWEB', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

//test fedora


use core\Middlewares\Dispatsher;

// autoload  de composer
require ROOT . 'vendor' . D_S . 'autoload.php';
// start application
$start = microtime(true);

Dispatsher::Dispatsher()

->pipe(core\Middlewares\Midd_PSR7_whoops::class)
->pipe(new core\Middlewares\Midd_PSR7_Router)

->run();





$fin = round(microtime(true) - $start, 5);

echo"<h5>" . $fin . ' secondes </h5>';
