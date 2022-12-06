<?php


namespace wfm;


class Registry
{
    //use TSingletone;

    ## test Singletone

    private static self|null $instance = null;

    private function __construct() {

    }

    public static function getInstance(): static {
        //return static::$instance ?? static::$instance = new static();
        return static::$instance ?? static::$instance = new Registry();
    }

    ## test Singletone

    protected static array $properties = [];

    public function setProperty($name, $value) {
        self::$properties[$name] = $value;
    }

    public function getProperty($name) {
        return self::$properties[$name] ?? null;
    }

    public function getProperties(): array {
        return self::$properties;
    }
}