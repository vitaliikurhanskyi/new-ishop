<?php


namespace core;


trait TSingletone
{
    private static self|null $instance = null;

    private function __construct() {

    }

    public static function getInstance(): static {
        return static::$instance ?? static::$instance = new static();
    }
}