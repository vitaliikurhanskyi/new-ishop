<?php

use core\App;

function debug($data, $exit = false) 
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($exit) {
        exit;
    }
}

function dd($data, $exit = false) 
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($exit) {
        exit;
    }
}

function htmlchars($str) 
{
    return htmlspecialchars($str);
}

function redirect($http = false)
{
	if($http) {
		$redirect = $http;
	} else {
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
	}

	header("Location: {$redirect}");

	exit;
}

function base_url()
{
    return PATH . '/' . (\core\App::$app->getProperty('lang') ? \core\App::$app->getProperty('lang') . '/' : '');
}

/**
 * @param string $key Key of GET array
 * @param string $type Values 'int', 'float', 'str'
 * @return float|int|string
 */
function get($key, $type = 'int')
{
    $param = $key;
    $$param = $_GET[$param] ?? '';
    if($type == 'int') {
        return (int)$$param;
    } else if ($type == 'float') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

/**
 * @param $key Key of POST array
 * @param string $type Values 'int', 'float', 'str'
 * @return float|int|string
 */
function post($key, $type = 'str')
{
    $param = $key;
    $$param = $_POST[$param] ?? '';
    if($type == 'int') {
        return (int)$$param;
    } else if ($type == 'float') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

function __($key)
{
    echo \core\Language::get($key);
}

function ___($key)
{
    return \core\Language::get($key);
}


