<?php

require_once('includes/template-loader.php');

class ErrorController
{
	public function executeError() {
		return load_template('error.php', array());
	}
}