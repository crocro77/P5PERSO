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
            $this->routes['/404']();
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
        $controller = new ErrorController();
        $controller->executeError();
});

$router->add_route('/comment/post', function(){
    $commentController = new FrontController();
    $commentController->executeCommentSheet();
});

$router->add_route('/comment/signal', function(){
    $signalController = new FrontController();
    $signalController->executeSignalComment();
});

$router->add_route('/comment/validate', function(){
    $validateComment = new AdminController();
 	$validateComment->executeValidateComment();
});

$router->add_route('/comment/delete', function(){
    $deleteComment = new AdminController();
    $deleteComment->executeDeleteComment();
});

$router->add_route('/comment/seen', function(){
    $seenComment = new AdminController();
    $seenComment->executeSeenComment();
});

// $router->add_route('/comment/deleteall', function(){
//     $seenComment = new AdminController();
//     $seenComment->executeDeleteAllComments();
// });

$router->add_route('/sheet/delete', function(){
    $deleteChapter = new AdminController();
    $deleteChapter->executeDeleteSheet();
});

// $router->add_route('/sheet/deleteall', function(){
//     $deleteChapter = new AdminController();
//     $deleteChapter->executeDeleteAllSheet();
// });

$router->add_route('/about/adddescription', function(){
    $addAbout = new AboutController();
    $addAbout->executeAddAbout();
});
// NON \\
$router->add_route('/about/updatedescription', function(){
    $updateAbout = new AboutController();
    $updateAbout->executeUpdateAbout();
});

$router->add_route('/about/deletedescription', function(){
    $deleteAbout = new AboutController();
    $deleteAbout->executeDeleteAbout();
});

$router->add_route('/chat/postchatmessage', function(){
    $chatMessage = new ChatController();
    $chatMessage->executeAddMessage();  
});

// $router->add_route('/chat/deleteall', function(){
//     $chatMessage = new AdminController();
//     $chatMessage->deleteChatMessages();  
// });
// ?? \\
$router->add_route('/contact/postcontactmessage', function(){
    $contactMessage = new ContactController();
    $contactMessage->executeContactForm();
});

// $router->add_route('/member/deleteaccount', function(){
//     $deleteAccount = new UsersController();
//     $deleteAccount->executeDeleteUser();
// });

$router->execute();