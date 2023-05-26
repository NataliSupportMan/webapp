<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f96a4359584257eac8b3d1c101c37fa
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit1f96a4359584257eac8b3d1c101c37fa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1f96a4359584257eac8b3d1c101c37fa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1f96a4359584257eac8b3d1c101c37fa::$classMap;

        }, null, ClassLoader::class);
    }
}
