<?php
/*
 * Front Controller
 * */

if(PHP_MAJOR_VERSION < 8) {
    die("You need version PHP more or equal 8.0");
}

require_once dirname(__DIR__) . "/config/init.php";
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';

new \core\App();

debug(\core\Router::getRoutes());



//throw new Exception("Error");





?>




