<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8021d2c3f6f4b891f1c4f57f015b320e
{
    public static $files = array (
        '7a0ceb2425f5f7b95da438a87efdcbd2' => __DIR__ . '/../..' . '/app/main.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Views\\' => 10,
            'App\\Models\\' => 11,
            'App\\Core\\' => 9,
            'App\\Controllers\\' => 16,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/views',
        ),
        'App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'App\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/core',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Controllers\\MessagesController' => __DIR__ . '/../..' . '/app/controllers/MessagesController.php',
        'App\\Core\\Connection' => __DIR__ . '/../..' . '/app/core/Connection.php',
        'App\\Core\\Controller' => __DIR__ . '/../..' . '/app/core/Controller.php',
        'App\\Core\\Model' => __DIR__ . '/../..' . '/app/core/Model.php',
        'App\\Core\\Route' => __DIR__ . '/../..' . '/app/core/Route.php',
        'App\\Core\\View' => __DIR__ . '/../..' . '/app/core/View.php',
        'App\\Models\\MessagesModel' => __DIR__ . '/../..' . '/app/models/MessagesModel.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8021d2c3f6f4b891f1c4f57f015b320e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8021d2c3f6f4b891f1c4f57f015b320e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8021d2c3f6f4b891f1c4f57f015b320e::$classMap;

        }, null, ClassLoader::class);
    }
}
