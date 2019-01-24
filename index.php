<?php

session_start();

require 'vendor/autoload.php';

// require 'models/Autoloader.php';
//\App\Autoloader::register();

function autoload($class)
{
	$class = str_replace('App\\', '', $class);
	if (file_exists($file = 'controllers/' . $class . '.php')) {
		require $file;
	} elseif (file_exists($file = 'models/' . $class . '.php')) {
		require $file;
	}
} 

spl_autoload_register('autoload');

require 'router.php';