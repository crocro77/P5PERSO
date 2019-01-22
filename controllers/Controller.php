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
	}
}