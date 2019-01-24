<?php

class ErrorController extends Controller
{
	public function executeError() {
		echo $this->twig->render('front/error.twig');
	}
}