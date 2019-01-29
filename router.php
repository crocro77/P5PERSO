<?php

class Router {

    /* Routes array where we store the various routes defined. */
    private $routes;

    /* The methods adds each route defined to the $routes array */
    function add_route($route, callable $closure) {
        $this->routes[$route] = $closure;
    }

    /* Execute the specified route defined */
    function execute() {
        $path = $_SERVER['REQUEST_URI'];
        var_dump($_SERVER['REQUEST_URI']);

 
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
    // echo 'Hello World';
});

/* Add another route as a closure */
$router->add_route('/game', function(){
    $controller = new FrontController();
    $controller->executeSingleSheet();
    // echo 'Greetings, my fellow men.';
});

/* Add another route as a closure */
$router->add_route('/contact', function(){
    $controller = new ContactController();
    $controller->executeContactForm();
    // echo 'Greetings, my fellow men.';
});

/* Add a route as a callback function */
$router->add_route('/callback', 'myFunction');

/* Callback function handler */
function myFunction(){
    echo "This is a callback function named '" .  __FUNCTION__ ."'";
}

/* Execute the router */
$router->execute();















// $url = '';
// if(isset($_GET['url'])) {
//     $url = $_GET['url'];
// }

// if($url == '') {
//     require 'views/front/home.twig';
// } elseif(preg_match('#article-([0-9]+)#', $url, $params)) {
//     $idArticle = $params[1];
//     require 'article.twig';
// } else {
//     require 'error.twig';
// }
