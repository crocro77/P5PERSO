<?php

// require_once('includes/template-loader.php');

class ErrorController extends Controller
{
	public function executeError() {
		// return load_template('front/error.php', array());
		echo $this->twig->render('front/error.twig');
	}
}