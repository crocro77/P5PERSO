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
    // echo 'Hello World';
});

/* Add another route as a closure */
$router->add_route('/game/sheet', function(){
    $controller = new FrontController();
    $controller->executeSingleSheet();
    // echo 'Greetings, my fellow men.';
});

/* Add another route as a closure */
$router->add_route('/chat', function(){
    $controller = new ChatController();
    $controller->executeChat();
    // echo 'Greetings, my fellow men.';
});

/* Add another route as a closure */
$router->add_route('/chat/update', function(){
    $controller = new ChatController();
    $controller->executeUpdateChat();
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















// class Router
// {
// 	/**
// 	* @var array $_listUri List of URI's to match against
// 	*/
// 	private $_listUri = array();
// 	/**
// 	* @var array $_listCall List of closures to call
// 	*/
// 	private $_listCall = array();
// 	/**
// 	* @var string $_trim Used class-wide items to clean strings
// 	*/
// 	private $_trim = '/\^$';
// 	/**
// 	* add_route - Adds a URI and Function to the two lists
// 	*
// 	* @param string $uri A path such as about/system
// 	* @param object $function An anonymous function
// 	*/
// 	public function add_Route($uri, $function)
// 	{
//         $uri = trim($uri, $this->_trim);
// 		$this->_listUri[] = $uri;
// 		$this->_listCall[] = $function;
// 	}
// 	/**
// 	* execute
//     * @desc Looks for a match for the URI and runs the related function
// 	*/
// 	public function execute()
// 	{
//         $url = 'http://localhost/'; 
//         $path = parse_url($url.$_SERVER['REQUEST_URI']);
//         // $path = $_SERVER['REQUEST_URI'];
//         var_dump($path);
// 		$uri = isset($_REQUEST['uri']) ? $_REQUEST['uri'] : '/home';
//         $uri = trim($uri, $this->_trim);
//         var_dump($uri);
// 		$replacementValues = array();
// 		/**
// 		* List through the stored URI's
// 		*/
// 		foreach ($this->_listUri as $listKey => $listUri)
// 		{
// 			/**
// 			* See if there is a match
// 			*/
// 			if (preg_match("#^$listUri$#", $uri))
// 			{
// 				/**
// 				* Replace the values
// 				*/
// 				$realUri = explode('/', $uri);
// 				$fakeUri = explode('/', $listUri);
// 				/**
// 				* Gather the .+ values with the real values in the URI
// 				*/
// 				foreach ($fakeUri as $key => $value)
// 				{
// 					if ($value == '.+')
// 					{
// 						$replacementValues[] = $realUri[$key];
// 					}
// 				}
// 				/**
// 				* Pass an array for arguments
// 				*/
// 				call_user_func_array($this->_listCall[$listKey], $replacementValues);
// 			}
// 		} // End of Loop
// 	} // end of Listen
// }

// $route = new Router();

// $route->add_route('/home', function() {
// 	$controller = new FrontController();
//     $controller->executeHome();
// });
// $route->add_route('/single', function() {
// 	 $controller = new FrontController();
//     $controller->executeSingleSheet();
// });
// $route->add_route('/contact', function() {
// 	$controller = new ContactController();
//     $controller->executeContactForm();
// });
// $route->add_route('/about', function() {
// 	$controller = new AboutController();
// 	$content = $controller->executeAbout();
// });
// $route->add_route('/mentions', function() {
// 	$controller = new FrontController();
// 	$content = $controller->executeMentions();
// });
// $route->add_route('/quiz', function() {
//     $controller = new QuizController();
//     $content = $controller->executeQuiz();
// });
// $route->add_route('/score', function() {
//     $controller = new QuizController();
// 	$content = $controller->executeScoreQuiz();
// });
// $route->add_route('/user', function() {
// 	$controller = new UsersController();
// 	$content = $controller->executeUsersSpace();
// });
// $route->add_route('/register', function() {
// 	$controller = new UsersController();
// 	$content = $controller->executeNewUser();
// });
// $route->add_route('/connection', function() {
// 	$controller = new UsersController();
// 	$content = $controller->executeUserLogin();
// });
// $route->add_route('/chat', function() {
// 	$controller = new ChatController();
// 	$content = $controller->executeChat();
// });
// $route->add_route('/login', function() {
// 	$controller = new AuthentificationController();
// 	$content = $controller->executeLogin();
// });
// // $route->add('/this/is/the/.+/story/of/.+', function($first, $second) {
// // 	echo "This is the $first story of $second";
// // });
// $route->add_route('/admin', function() {
//     $controller = new AdminController();
// 	$content = $controller->executeAdminDashboard();
// });
// $route->execute();