<?php

session_start();

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

$pageTitle = "Liste des jeux Game Gear";

if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

switch ($p) {
	case "home":
		$pageTitle .= ' - Bienvenue';
		$controller = new BlogController();
		$content = $controller->executeHome();
		break;
	case "single":
		$controller = new BlogController();
		$content = $controller->executeSingle();
		break;
	// case "admin":
	// 	if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'j.forteroche') {
	// 		header('Location: index.php?p=login');
	// 	} else {
	// 		$pageTitle .= ' - Tableau de bord';
	// 		$controller = new AdminController();
	// 		$content = $controller->executeAdminPanel();
	// 	}
	// 	break;
	// case "login":
	// 	if(isset($_SESSION['username']) AND $_SESSION['username'] == 'j.forteroche') {
	// 		header('Location: index.php');
	// 	} else {
	// 		$pageTitle .= ' - Connexion';
	// 		$controller = new AdminController();
	// 		$content = $controller->executeLogin();
	// 	}
	// 	break;
	// case "logout":
	// 	session_start();
	// 	session_destroy();
	// 	header('Location: index.php');
	// 	exit();
	// 	break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}

require 'views/template/default.php';