<?php
/*
 * Front Controller
 * */

echo '<p style="color:green; position:fixed; z-index:9999;">video 11 || 5:00 <hr></p>';
exit;

if(PHP_MAJOR_VERSION < 8) {
    die("You need version PHP more or equal 8.0");
}

require_once dirname(__DIR__) . "/config/init.php";
require_once HELPERS . '/functions.php';
require_once CONFIG . '/routes.php';

new \core\App();