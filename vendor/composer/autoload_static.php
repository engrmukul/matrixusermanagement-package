<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8882e1090e65634191918a6494d9bce
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mukul\\Matrixusermanagement\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mukul\\Matrixusermanagement\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8882e1090e65634191918a6494d9bce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8882e1090e65634191918a6494d9bce::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
