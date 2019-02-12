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
// "ROUTES" //
// OK
$router->add_route('/home', function(){
    $controller = new FrontController();
    $controller->executeHome();
});
// OK
$router->add_route('/game/sheet', function(){
    $controller = new FrontController();
    $controller->executeSingleSheet();
});
// OK
$router->add_route('/chat', function(){
    $controller = new ChatController();
    $controller->executeChat();
});
// OK
$router->add_route('/chat/update', function(){
    $controller = new ChatController();
    $controller->executeUpdateChat();
});
// OK
$router->add_route('/quiz', function(){
    $controller = new QuizController();
    $controller->executeQuiz();
});
// OK
$router->add_route('/score', function(){
    $controller = new QuizController();
 	$controller->executeScoreQuiz();
});
// OK
$router->add_route('/user', function(){
    $controller = new UsersController();
    $controller->executeUsersSpace();
});
// OK
$router->add_route('/connection', function(){
 	$controller = new UsersController();
 	$controller->executeUserLogin();
});
// OK
$router->add_route('/register', function(){
 	$controller = new UsersController();
    $controller->executeNewUser();
});
// OK
$router->add_route('/about', function(){
 	$controller = new AboutController();
 	$controller->executeAbout();
});
// OK
$router->add_route('/contact', function(){
 	$controller = new ContactController();
    $controller->executeContactForm();
});
// OK
$router->add_route('/mentions', function(){
 	$controller = new FrontController();
 	$controller->executeMentions();
});
// OK
$router->add_route('/login', function(){
 	$controller = new AuthentificationController();
 	$controller->executeLogin();
});
// OK
$router->add_route('/admin', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});
// OK
$router->add_route('/logout', function(){
    $controller = new AuthentificationController();
	$controller->executeLogout();
});
// OK
$router->add_route('/member', function(){
    $controller = new UsersController();
	$controller->executeUserDashboard();
});
// OK SAUF MP3
$router->add_route('/write', function(){
    $createController = new AdminController();
	$createController->executeCreateSheet();
});
//OK
$router->add_route('/memberwrite', function(){
    $createController = new UsersController();
	$createController->executeMemberCreateSheet();
});
// OK SAUF LES FILE-UPLOADS
$router->add_route('/edit', function(){
    $updateChapter = new AdminController();
    $updateChapter->executeUpdateSheet();
});
// OK
$router->add_route('/404', function(){
        $controller = new ErrorController();
        $controller->executeError();
});
// "ACTIONS" //
// OK
$router->add_route('/comment/post', function(){
    $commentController = new FrontController();
    $commentController->executeCommentSheet();
});
// NON
$router->add_route('/comment/signal', function(){
    $signalController = new FrontController();
    $signalController->executeSignalComment();
});
// OK
$router->add_route('/comment/validate', function(){
    $validateComment = new AdminController();
 	$validateComment->executeValidateComment();
});
// OK
$router->add_route('/comment/delete', function(){
    $deleteComment = new AdminController();
    $deleteComment->executeDeleteComment();
});
// OK
$router->add_route('/comment/seen', function(){
    $seenComment = new AdminController();
    $seenComment->executeSeenComment();
});
// NON TESTE
$router->add_route('/comment/deleteall', function(){
    $seenComment = new AdminController();
    $seenComment->executeDeleteAllComments();
});
// OK
$router->add_route('/sheet/delete', function(){
    $deleteChapter = new AdminController();
    $deleteChapter->executeDeleteSheet();
});
// NON TESTE
$router->add_route('/sheet/deleteall', function(){
    $deleteChapter = new AdminController();
    $deleteChapter->executeDeleteAllSheet();
});
// NON
$router->add_route('/about/adddescription', function(){
    $addAbout = new AboutController();
    $addAbout->executeAddAbout();
});
// NON
$router->add_route('/about/updatedescrption', function(){
    $updateAbout = new AboutController();
    $updateAbout->executeUpdateAbout();
});
// OK
$router->add_route('/about/deletedescription', function(){
    $deleteAbout = new AboutController();
    $deleteAbout->executeDeleteAbout();
});
// OK
$router->add_route('/chat/postchatmessage', function(){
    $chatMessage = new ChatController();
    $chatMessage->executeAddMessage();  
});
// NON TESTE
$router->add_route('/chat/deleteall', function(){
    $chatMessage = new AdminController();
    $chatMessage->deleteChatMessages();  
});
// ??
$router->add_route('/contact/postcontactmessage', function(){
    $contactMessage = new ContactController();
    $contactMessage->executeContactForm();
});
// NON
$router->add_route('/member/deleteaccount', function(){
    $deleteAccount = new UsersController();
    $deleteAccount->executeDeleteUser();
});

$router->execute();