<?php

class Router {

    const DIRECTORY = 'PROJET5PERSO';
    
    private $routes;

    function add_route($route, callable $closure) {
        $this->routes[$route] = $closure;
    }

    function execute() {
        $url = 'http://localhost/';
        $urldata = parse_url($url.$_SERVER['REQUEST_URI']);
		$path = $urldata['path'];
		$path =	trim ($path, '/');
		$path = preg_replace('/'.self::DIRECTORY.'/','',$path);
		
        if(array_key_exists($path, $this->routes)) {
            $this->routes[$path]();
        } else {
            $this->routes['/home']();
        }
    }   
}

$router = new Router();

$router->add_route('/home', function(){
    $controller = new FrontController();
    $controller->executeHome();
});

$router->add_route('/game/sheet', function(){
    $controller = new FrontController();
    $controller->executeSingleSheet();
});

$router->add_route('/chat', function(){
    $controller = new ChatController();
    $controller->executeChat();
});

$router->add_route('/chat/update', function(){
    $controller = new ChatController();
    $controller->executeUpdateChat();
});

$router->add_route('/quiz', function(){
    $controller = new QuizController();
    $controller->executeQuiz();
});

$router->add_route('/score', function(){
    $controller = new QuizController();
 	$controller->executeScoreQuiz();
});

$router->add_route('/user', function(){
    $controller = new UsersController();
    $controller->executeUsersSpace();
});

$router->add_route('/connection', function(){
 	$controller = new UsersController();
 	$controller->executeUserLogin();
});

$router->add_route('/register', function(){
 	$controller = new UsersController();
    $controller->executeNewUser();
});

$router->add_route('/about', function(){
 	$controller = new AboutController();
 	$controller->executeAbout();
});

$router->add_route('/contact', function(){
 	$controller = new ContactController();
    $controller->executeContactForm();
});

$router->add_route('/mentions', function(){
 	$controller = new FrontController();
 	$controller->executeMentions();
});

$router->add_route('/login', function(){
 	$controller = new AuthentificationController();
 	$controller->executeLogin();
});

$router->add_route('/admin', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});

$router->add_route('/admin/list', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});

$router->add_route('/admin/comments', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});

$router->add_route('/admin/settings/', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});

$router->add_route('/admin', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});

$router->add_route('/logout', function(){
    $controller = new AuthentificationController();
	$controller->executeLogout();
});

$router->add_route('/member', function(){
    $controller = new UsersController();
	$controller->executeUserDashboard();
});

$router->add_route('/write', function(){
    $createController = new AdminController();
	$createController->executeCreateSheet();
});

$router->add_route('/memberwrite', function(){
    $createController = new UsersController();
	$createController->executeMemberCreateSheet();
});

$router->add_route('/edit', function(){
    $updateChapter = new AdminController();
    $updateChapter->executeUpdateSheet();
});

$router->add_route('/404', function(){
    if($path = false) {
        $controller = new ErrorController();
        $controller->executeError();
    }
});

/* Add a route as a callback function */
// $router->add_route('/callback', 'myFunction');

/* Callback function handler */
// function myFunction(){
//     echo "This is a callback function named '" .  __FUNCTION__ ."'";
// }

$router->execute();

/// ANCIEN ROUTER ///

// if (isset($_GET['action'])) {
// 	switch ($_GET['action']) {
// 		case "postcomment":
// 			$commentController = new FrontController();
// 			$content = $commentController->executeCommentSheet();
// 			break;
// 		case "signalcomment":
// 			$signalController = new FrontController();
// 			$content = $signalController->executeSignalComment($_GET['commentId']);
// 			break;
// 		case "validatecomment":
// 			$validateComment = new AdminController();
// 			$content = $validateComment->executeValidateComment();
// 			break;
// 		case "deletecomment":
// 			$deleteComment = new AdminController();
// 			$content = $deleteComment->executeDeleteComment();
// 			break;
// 		case "seencomment":
// 			$seenComment = new AdminController();
// 			$content = $seenComment->executeSeenComment();
// 			break;
// 		case "deletesheet":
// 			$deleteChapter = new AdminController();
// 			$content = $deleteChapter->executeDeleteSheet();
// 			break;
// 		case "addaboutdescription":
// 			$addAbout = new AboutController();
// 			$content = $addAbout->executeAddAbout();
// 			break;
// 		case "updateaboutdescription":
// 			$updateAbout = new AboutController();
// 			$content = $updateAbout->executeUpdateAbout();
// 			break;
// 		case "deleteaboutdescription":
// 			$deleteAbout = new AboutController();
// 			$content = $deleteAbout->executeDeleteAbout();
// 			break;
// 		case "postchatmessage":
// 			$chatMessage = new ChatController();
// 			$content = $chatMessage->executeAddMessage();
// 			break;
// 		case "postmessage":
// 			$contactMessage = new ContactController();
// 			$content = $contactMessage->executeContactForm();
// 			break;
// 		case "deleteaccount":
// 			$deleteAccount = new UsersController();
// 			$content = $deleteAccount->executeDeleteUser();
// 		break;
// 	}
// }

// if (isset($_GET['p'])) {
// 	$p = $_GET['p'];
// } else {
// 	$p = 'home';
// }

// switch ($p) {
// 	case "home":
// 		$controller = new FrontController();
// 		$content = $controller->executeHome();
// 		break;
// 	case "single":
// 		$controller = new FrontController();
// 		$content = $controller->executeSingleSheet();
// 		break;
// 	case "mentions":
// 		$controller = new FrontController();
// 		$content = $controller->executeMentions();
// 		break;
// 	case "about":
// 		$controller = new AboutController();
// 		$content = $controller->executeAbout();
// 		break;
// 	case "contact":
// 		$controller = new ContactController();
// 		$content = $controller->executeContactForm();
// 		break;
// 	case "chat":
// 		$controller = new ChatController();
// 		$content = $controller->executeChat();
// 		break;
// 	case "quiz":
// 		$controller = new QuizController();
// 		$content = $controller->executeQuiz();
// 		break;
// 	case "score":
// 		$controller = new QuizController();
// 		$content = $controller->executeScoreQuiz();
// 		break;
// 	case "user":
// 		$controller = new UsersController();
// 		$content = $controller->executeUsersSpace();
// 		break;
// 	case "connection":
// 		$controller = new UsersController();
// 		$content = $controller->executeUserLogin();
// 		break;
// 	case "register":
// 		$controller = new UsersController();
// 		$content = $controller->executeNewUser();
// 		break;
// 	case "admin":
// 		$controller = new AdminController();
// 		$content = $controller->executeAdminDashboard();
// 		break;
// 	case "member":
// 		$controller = new UsersController();
// 		$content = $controller->executeUserDashboard();
// 		break;
// 	case "write":
// 		$createController = new AdminController();
// 		$content = $createController->executeCreateSheet();
// 		break;
// 	case "memberwrite":
// 		$createController = new UsersController();
// 		$content = $createController->executeMemberCreateSheet();
// 		break;
// 	case "edit":
// 		$updateChapter = new AdminController();
// 		$content = $updateChapter->executeUpdateSheet();
// 		break;
// 	case "login":
// 		$controller = new AuthentificationController();
// 		$content = $controller->executeLogin();
// 		break;
// 	case "logout":
// 		$controller = new AuthentificationController();
// 		$content = $controller->executeLogout();
// 		break;
// 	case "updatechat":
// 		$updateChat = new ChatController();
// 		$updateChat->executeUpdateChat();
// 	break;
// 	default:
// 		$controller = new ErrorController();
// 		$content = $controller->executeError();
// }