<?php

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

