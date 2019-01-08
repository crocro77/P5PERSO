<?php

session_start();

require 'vendor/autoload.php';

/**
 * Autoloader permettant de charger les différentes classes.
 * @param string $classname Le nom de la classe à charger
 */
function autoload($classname)
{
	if (file_exists($file = 'controllers/' . $classname . '.php')) {
		require $file;
	} elseif (file_exists($file = 'models/' . $classname . '.php')) {
		require $file;
	} elseif (file_exists($file = 'includes/' . $classname . '.php')) {
		require $file;
	}
}

spl_autoload_register('autoload');

require 'routertest.php';
// require 'router.php';
// require 'views/template/default.php';
require 'views/template/layout.twig';