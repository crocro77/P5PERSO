<?php

session_start();

// require 'vendor/autoload.php';

// require 'models/Autoloader.php';
//\app\
// Autoloader::register();

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

$pageTitle = "World of Game Gear";

require 'router.php';
require 'views/template/default.php';
// require 'routertest.php';
// require 'views/template/layout.twig';