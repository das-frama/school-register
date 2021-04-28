<?php

ini_set('display_errors', 1);

define('ROOT', substr(__DIR__, 0, -6));
define('SRC', ROOT . DIRECTORY_SEPARATOR . 'src');

session_start();

require SRC . '/router.php';
execute_route();
