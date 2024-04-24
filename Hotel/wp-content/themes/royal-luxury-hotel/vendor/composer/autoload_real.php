<?php

// autoload_real.php @generated by Composer

class Royal_Luxury_Hotel_ComposerAutoloaderInit75f95ca3778976eb5c1bf35fe42ac3d4
{
    private static $loader;

    public static function royal_luxury_hotel_loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            //require __DIR__ . '/ClassLoader.php';
            load_template( trailingslashit( get_template_directory() ) . '/ClassLoader.php' );
        }
    }

    public static function royal_luxury_hotel_getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit75f95ca3778976eb5c1bf35fe42ac3d4', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit75f95ca3778976eb5c1bf35fe42ac3d4', 'loadClassLoader'));

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            //require_once __DIR__ . '/autoload_static.php';
             load_template( trailingslashit( get_template_directory() ) . '/autoload_static.php' );

            call_user_func(\Composer\Autoload\ComposerStaticInit75f95ca3778976eb5c1bf35fe42ac3d4::getInitializer($loader));
        } else {
            //$map = require __DIR__ . '/autoload_namespaces.php';
            $map = load_template( trailingslashit( get_template_directory() ) . '/autoload_namespaces.php' );
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            //$map = require __DIR__ . '/autoload_psr4.php';
            $map = load_template( trailingslashit( get_template_directory() ) . '/autoload_psr4.php' );
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            //$classMap = require __DIR__ . '/autoload_classmap.php';
            $classMap = load_template( trailingslashit( get_template_directory() ) . '/autoload_classmap.php' );
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        return $loader;
    }
}
