<?php

require_once('includes/template-loader.php');

class BlogController
{
	public function executeHome()
	{
		// Nombre de chapitre voulu par page.
		$sheetsPerPage = 8;

		// On compte le nombre total de chapitre présents dans la bdd.
		$sheetManager = new Datasheet();
		$numberOfSheets = $sheetManager->count();

		// Nombre de pages.
		$numberOfPages = ceil($numberOfSheets / $sheetsPerPage);

		$currentPage = 1;
		
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = intval($_GET['page']);

			if ($currentPage > $numberOfPages) {
				$currentPage = $numberOfPages;
			}
		} else {
			$currentPage = 1;
		}
		

		$firstSheet = ($currentPage - 1) * $sheetsPerPage;
		$listOfSheets = $sheetManager->getList($firstSheet, $sheetsPerPage);

		return load_template('home.php', array('listOfSheets' => $listOfSheets, 'numberOfPages' => $numberOfPages, 'currentPage' => $currentPage));
    }
}