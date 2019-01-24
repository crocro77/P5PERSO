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
			$content = $contactMessage->executeContactForm();
			break;
		case "deleteaccount":
			$deleteAccount = new UsersController();
			$content = $deleteAccount->executeDeleteUser();
		break;
	}
}

if (isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'home';
}

switch ($p) {
	case "home":
		$controller = new FrontController();
		$content = $controller->executeHome();
		break;
	case "single":
		$controller = new FrontController();
		$content = $controller->executeSingleSheet();
		break;
	case "mentions":
		$controller = new FrontController();
		$content = $controller->executeMentions();
		break;
	case "about":
		$controller = new AboutController();
		$content = $controller->executeAbout();
		break;
	case "contact":
		$controller = new ContactController();
		$content = $controller->executeContactForm();
		break;
	case "chat":
		$controller = new ChatController();
		$content = $controller->executeChat();
		break;
	case "quiz":
		$controller = new QuizController();
		$content = $controller->executeQuiz();
		break;
	case "score":
		$controller = new QuizController();
		$content = $controller->executeScoreQuiz();
		break;
	case "user":
		$controller = new UsersController();
		$content = $controller->executeUsersSpace();
		break;
	case "connection":
		$controller = new UsersController();
		$content = $controller->executeUserLogin();
		break;
	case "register":
		$controller = new UsersController();
		$content = $controller->executeNewUser();
		break;
	case "admin":
		$controller = new AdminController();
		$content = $controller->executeAdminDashboard();
		break;
	case "member":
		$controller = new UsersController();
		$content = $controller->executeUserDashboard();
		break;
	case "write":
		$createController = new AdminController();
		$content = $createController->executeCreateSheet();
		break;
	case "memberwrite":
		$createController = new UsersController();
		$content = $createController->executeMemberCreateSheet();
		break;
	case "edit":
		$updateChapter = new AdminController();
		$content = $updateChapter->executeUpdateSheet();
		break;
	case "login":
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