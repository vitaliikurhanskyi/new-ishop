<?php
/*
 * Front Controller
 * */

if(PHP_MAJOR_VERSION < 8) {
    die("You need version PHP more or equal 8.0");
}

require_once dirname(__DIR__) . "/config/init.php";

new \wfm\App();

//echo \wfm\App::$app->getProperty('site_name');
//
//\wfm\App::$app->setProperty('test', 'test');
//
//var_dump(\wfm\App::$app->getProperties());

echo "<hr>";

?>




