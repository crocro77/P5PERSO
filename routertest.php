<?php

// Routing
if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

// Rendu du template
$loader = new Twig_Loader_Filesystem(__DIR__ . '/views/');
$twig = new Twig_Environment($loader, [
	'cache' => false // __DIR__ . '/tmp'

]);

switch ($p) {
	case "home":
		echo $twig->render('front/hometest.twig', ['datasheet' => Datasheet::getList(), ]);
		break;
	case "single":
		echo $twig->render('front/singletest.twig');//['sheetUnique' => Datasheet::getUnique($id)]);
		break;
	case "about":
		echo $twig->render('front/abouttest.twig');
		break;
	case "contact":
		echo $twig->render('front/contacttest.twig');
		break;
	case "mentions":
		echo $twig->render('front/mentionstest.twig');	
		break;
	case "chat":
		echo $twig->render('front/chattest.twig');
		break;
	case "quiz":
		echo $twig->render('front/quiztest.twig');
		break;
	case "score":
		echo $twig->render('front/scoretest.twig');
		break;
	case "user":
		echo $twig->render('front/userstest.twig');
		break;
	case "connection":
		echo $twig->render('front/userlogintest.twig');
		break;
	case "register":
		echo $twig->render('front/registertest.twig');
		break;
	case "login":
		echo $twig->render('admin/logintest.twig');
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'ntonyyy') {
			header('Location: index.php?p=login');
		} else {
			echo $twig->render('admin/dashboard.twig');
		}
	case "logout":
		$controller = new AuthentificationController();
		$content = $controller->executeLogout();
		break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}