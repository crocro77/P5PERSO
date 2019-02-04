<?php

class Router {

    const DIRECTORY = 'PROJET5PERSO';
    
    /* Routes array where we store the various routes defined. */
    private $routes;

    /* The methods adds each route defined to the $routes array */
    function add_route($route, callable $closure) {
        $this->routes[$route] = $closure;
    }

    /* Execute the specified route defined */
    function execute() {
        $url = 'http://localhost/';
        $urldata = parse_url($url.$_SERVER['REQUEST_URI']);
		$path = $urldata['path'];
		$path =	trim ($path, '/');
		$path = preg_replace('/'.self::DIRECTORY.'/','',$path);
		
        /* Check if the given route is defined,
         * or execute the default '/' home route.
         */
        if(array_key_exists($path, $this->routes)) {
            $this->routes[$path]();
        } else {
            $this->routes['/home']();
        }
    }   
}

/* Create a new router */
$router = new Router();

/* Add a Homepage route as a closure */
$router->add_route('/home', function(){
    $controller = new FrontController();
    $controller->executeHome();
});

/* Add another route as a closure */
$router->add_route('/game/sheet', function(){
    $controller = new FrontController();
    $controller->executeSingleSheet();
});

/* Add another route as a closure */
$router->add_route('/chat', function(){
    $controller = new ChatController();
    $controller->executeChat();
});

/* Add another route as a closure */
$router->add_route('/chat/update', function(){
    $controller = new ChatController();
    $controller->executeUpdateChat();
});

/* Add another route as a closure */
$router->add_route('/quiz', function(){
    $controller = new QuizController();
    $controller->executeQuiz();
});

/* Add another route as a closure */
$router->add_route('/score', function(){
    $controller = new QuizController();
 	$controller->executeScoreQuiz();
});

/* Add another route as a closure */
$router->add_route('/user', function(){
    $controller = new UsersController();
    $controller->executeUsersSpace();
});

/* Add another route as a closure */
$router->add_route('/connection', function(){
 	$controller = new UsersController();
 	$controller->executeUserLogin();
});

/* Add another route as a closure */
$router->add_route('/register', function(){
 	$controller = new UsersController();
    $controller->executeNewUser();
});
// $route->add_route('/about', function() {

// });
/* Add another route as a closure */
$router->add_route('/about', function(){
 	$controller = new AboutController();
 	$controller->executeAbout();
});

/* Add another route as a closure */
$router->add_route('/contact', function(){
 	$controller = new ContactController();
    $controller->executeContactForm();
});

/* Add another route as a closure */
$router->add_route('/mentions', function(){
 	$controller = new FrontController();
 	$controller->executeMentions();
});

/* Add another route as a closure */
$router->add_route('/login', function(){
 	$controller = new AuthentificationController();
 	$controller->executeLogin();
});

/* Add another route as a closure */
$router->add_route('/admin', function(){
    $controller = new AdminController();
    $controller->executeAdminDashboard();
});

/* Add another route as a closure */
$router->add_route('/logout', function(){
    $controller = new AuthentificationController();
	$controller->executeLogout();
});

/* Add another route as a closure */
$router->add_route('/member', function(){
    $controller = new UsersController();
	$controller->executeUserDashboard();
});

/* Add another route as a closure */
$router->add_route('/write', function(){
    $createController = new AdminController();
	$createController->executeCreateSheet();
});

/* Add another route as a closure */
$router->add_route('/memberwrite', function(){
    $createController = new UsersController();
	$createController->executeMemberCreateSheet();
});

/* Add another route as a closure */
$router->add_route('/edit', function(){
    $updateChapter = new AdminController();
    $updateChapter->executeUpdateSheet();
});

// $controller = new ErrorController();
// $controller->executeError();

/* Add a route as a callback function */
$router->add_route('/callback', 'myFunction');

/* Callback function handler */
function myFunction(){
    echo "This is a callback function named '" .  __FUNCTION__ ."'";
}

/* Execute the router */
$router->execute();