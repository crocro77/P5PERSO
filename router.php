<?php

// Routing
if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

switch ($p) {
	case "home":
		$pageTitle .= ' - Bienvenue';
		$controller = new FrontController();
		$content = $controller->executeHome();
		break;
	case "single":
		$controller = new FrontController();
		$content = $controller->executeSingle();
		break;
	case "about":
		$pageTitle .= ' - À propos';
		$controller = new FrontController();
		$content = $controller->executeAbout();
		break;
	case "mentions":
		$pageTitle .= ' - Mentions légales';
		$controller = new FrontController();
		$content = $controller->executeMentions();
		break;
	case "chat":
		$pageTitle .= ' - Chat';
		$controller = new ChatController();
		$content = $controller->executeChat();
		break;
	case "quiz":
		$pageTitle .= ' - Quiz';
		$controller = new QuizController();
		$content = $controller->executeQuiz();
		break;
	case "score":
		$pageTitle .= ' - Score du Quiz';
		$controller = new QuizController();
		$content = $controller->executeScoreQuiz();
		break;
	case "user":
		$pageTitle .= ' - Espace Membres';
		$controller = new UsersController();
		$content = $controller->executeUsersSpace();
		break;
	case "connection":
		$pageTitle .= ' - Connexion à l\'Espace Membres';
		$controller = new UsersController();
		$content = $controller->executeUserLogin();
		break;
	case "register":
		$pageTitle .= ' - Inscription à l\'Espace Membres';
		$controller = new UsersController();
		$content = $controller->executeUserRegister();
		break;
	case "admin":
		if(!isset($_SESSION['username']) OR isset($_SESSION['username']) AND $_SESSION['username'] !== 'ntonyyy') {
			header('Location: index.php?p=login');
		} else {
			$pageTitle .= ' - Tableau de bord';
			$controller = new AdminController();
			$content = $controller->executeAdminPanel();
		}
		break;
	case "login":
		$pageTitle .= ' - Connexion';
		$controller = new AuthentificationController();
		$content = $controller->executeLogin();
		break;
	case "logout":
		$controller = new AuthentificationController();
		$content = $controller->executeLogout();
		break;
	default:
		$controller = new ErrorController();
		$content = $controller->executeError();
}