<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitad3e6711d8ec12a2b1703544357c0665
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitad3e6711d8ec12a2b1703544357c0665::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitad3e6711d8ec12a2b1703544357c0665::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitad3e6711d8ec12a2b1703544357c0665::$classMap;

        }, null, ClassLoader::class);
    }
}
