<?php

function debug($data, $die = false) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($die) {
        die;
    }
}

function dd($data, $die = false) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($die) {
        die;
    }
}

function htmlchars($str) {
    return htmlspecialchars($str);
}