<?php


namespace core;


class Router
{
    protected static array $routes = [];
    protected static array $route = [];

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array {
        return self::$routes;
    }

    public static function getRoute(): array {
        return self::$route;
    }

    public static function dispatch($url) {
        if(self::matchRoute($url)) {
            echo "Ok";
        } else {
            echo "No";
        }
    }

    public static function matchRoute($url): bool {
        foreach (self::$routes as $patern => $route) {
            if(preg_match("#{$patern}#i", $url, $matches)) {
                //debug($matches);
                foreach ($matches as $key => $value) {
                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if(empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if(!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] = '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                debug($route);
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase($name): string {
        $name = str_replace('-', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }

    protected static function lowerCamelCase($name): string {
        return lcfirst(self::upperCamelCase($name));
    }

}