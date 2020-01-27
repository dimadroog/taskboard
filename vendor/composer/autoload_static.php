<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit037812fd488e860f72145195d54c24aa
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rakit\\Validation\\' => 17,
        ),
        'M' => 
        array (
            'Medoo\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rakit\\Validation\\' => 
        array (
            0 => __DIR__ . '/..' . '/rakit/validation/src',
        ),
        'Medoo\\' => 
        array (
            0 => __DIR__ . '/..' . '/catfan/medoo/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'J' => 
        array (
            'JasonGrimes' => 
            array (
                0 => __DIR__ . '/..' . '/jasongrimes/paginator/src',
            ),
        ),
    );

    public static $classMap = array (
        'Zebra_Pagination' => __DIR__ . '/..' . '/stefangabos/zebra_pagination/Zebra_Pagination.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit037812fd488e860f72145195d54c24aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit037812fd488e860f72145195d54c24aa::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit037812fd488e860f72145195d54c24aa::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit037812fd488e860f72145195d54c24aa::$classMap;

        }, null, ClassLoader::class);
    }
}