<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9f16d58bed076fe91ab04ea69a750609
{
    public static $files = array (
        'a0063ca44df31a81bb0634cab48f040a' => __DIR__ . '/..' . '/ebanx/benjamin/main.php',
    );

    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Ebanx\\Benjamin\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ebanx\\Benjamin\\' => 
        array (
            0 => __DIR__ . '/..' . '/ebanx/benjamin/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9f16d58bed076fe91ab04ea69a750609::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9f16d58bed076fe91ab04ea69a750609::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
