<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit37eb0ae76aa31e0d8c5762afb78463c0
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'test\\' => 5,
        ),
        'c' => 
        array (
            'core\\' => 5,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'test\\' => 
        array (
            0 => __DIR__ . '/../..' . '/test',
        ),
        'core\\' => 
        array (
            0 => __DIR__ . '/..' . '/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit37eb0ae76aa31e0d8c5762afb78463c0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit37eb0ae76aa31e0d8c5762afb78463c0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit37eb0ae76aa31e0d8c5762afb78463c0::$classMap;

        }, null, ClassLoader::class);
    }
}
