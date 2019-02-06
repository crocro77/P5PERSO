<?php

abstract class Controller
{
	public $loader;
	public $twig;

	// TEST 1 public $function;
	// TEST 2 public $view;

	public function __construct()
	{
		$this->loader = new Twig_Loader_Filesystem('views/');
		$this->twig = new Twig_Environment($this->loader, [
			'cache' => false, //__DIR__ . '/tmp'
		]);
		$this->twig->addGlobal('_session', $_SESSION);
		$this->twig->addGlobal('_post', $_POST);
		$this->twig->addGlobal('_get', $_GET);

		// TEST 1
		// $this->function = new Twig_SimpleFunction('flashMessage', function ()
		// {
		// 	if(isset($_SESSION['flash'])) {
		// 		foreach($_SESSION['flash'] as $type => $message) {
		// 		?
		// 		<div class="alert alert-<?= $type; ?">
		// 			<?= $message; ?
		// 		</div>
		// 		<?php
		// 		}
		// 		unset($_SESSION['flash']);
		// 	}
		// });

		// $this->twig->addFunction($this->function);
		
		// TEST 2
		// $this->view->addExtension(new FlashMessages());
	}
}