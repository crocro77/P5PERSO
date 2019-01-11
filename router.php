<?php

if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case "postcomment":
			$commentController = new FrontController();
			$content = $commentController->executeCommentSheet();
			break;
		case "signalcomment":
			$signalController = new FrontController();
			$content = $signalController->executeSignalComment($_GET['commentId']);
			break;
		case "validatecomment":
			$validateComment = new AdminController();
			$content = $validateComment->executeValidateComment();
			break;
		case "deletecomment":
			$deleteComment = new AdminController();
			$content = $deleteComment->executeDeleteComment();
			break;
		case "seencomment":
			$seenComment = new AdminController();
			$content = $seenComment->executeSeenComment();
			break;
		case "deletesheet":
			$deleteChapter = new AdminController();
			$content = $deleteChapter->executeDeleteSheet();
			break;
		case "addaboutdescription":
			$addAbout = new AboutController();
			$content = $addAbout->executeAddAbout();
			break;
		case "updateaboutdescription":
			$updateAbout = new AboutController();
			$content = $updateAbout->executeUpdateAbout();
			break;
		case "deleteaboutdescription":
			$deleteAbout = new AboutController();
			$content = $deleteAbout->executeDeleteAbout();
			break;
		case "postchatmessage":
			$chatMessage = new ChatController();
			$content = $chatMessage->executeAddMessage();
			break;
		case "postmessage":
			$contactMessage = new ContactController();
			$content = $contactMessage->executeSendMessage();
			break;
		case "memberregister":
			$memberRegister = new UsersController();
			$content = $memberRegister->executeAddUser();
			break;
		case "memberaccess":
			$memberAccess = new UsersController();
			$content = $memberAccess->executeUserAccess();
	}
}

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
		$content = $controller->executeSingleSheet();
		break;
	case "mentions":
		$pageTitle .= ' - Mentions légales';
		$controller = new FrontController();
		$content = $controller->executeMentions();
		break;
	case "about":
		$pageTitle .= ' - À propos';
		$controller = new AboutController();
		$content = $controller->executeAbout();
		break;
	case "contact":
		$pageTitle .= ' - Contact';
		$controller = new ContactController();
		$content = $controller->executeContact();
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
		$pageTitle .= ' - Tableau de bord';
		$controller = new AdminController();
		$content = $controller->executeAdminDashboard();
		break;
	case "write":
		$createController = new AdminController();
		$content = $createController->executeCreateSheet();
		break;
	case "edit":
		$updateChapter = new AdminController();
		$content = $updateChapter->executeUpdateSheet();
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