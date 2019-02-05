<?php

session_start();

require 'vendor/autoload.php';

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

require 'Router.php';