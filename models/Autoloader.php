<?php

// namespace app;

/**
 * Autoloader permettant de charger les différentes classes.
 * @param string $classname Le nom de la classe à charger
 */
// class Autoloader
// {
//     public static function autoload($classname)
//     {
//         if (file_exists($file = 'controllers/' . $classname . '.php')) {
//             require $file;
//         } elseif (file_exists($file = 'models/' . $classname . '.php')) {
//             require $file;
//         } elseif (file_exists($file = 'includes/' . $classname . '.php')) {
//             require $file;
//         }
//     }

//     public static function register()
//     {
//         spl_autoload_register(autoload);
//     }
// }