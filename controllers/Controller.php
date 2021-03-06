<?php

abstract class Controller
{
	public $loader;
	public $twig;

	public function __construct()
	{
		$this->loader = new Twig_Loader_Filesystem('views/');
		$this->twig = new Twig_Environment($this->loader, [
			'cache' => false, //__DIR__ . '/tmp'
		]);
		$this->twig->addGlobal('_session', $_SESSION);
		$this->twig->addGlobal('_post', $_POST);
		$this->twig->addGlobal('_get', $_GET);

		$function = new Twig_SimpleFunction('generateURL', function ($path) {
			$domain = 'http://localhost';
			$directory = 'PROJET5PERSO';
			$url = $domain.'/'.$directory.'/'.$path;
			return $url;
		});
		$this->twig->addFunction($function);
	}
}