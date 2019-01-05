<?php

require_once('includes/template-loader.php');

class ErrorController
{
	public function executeError() {
		return load_template('front/error.php', array());
	}
}