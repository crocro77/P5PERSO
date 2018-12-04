<?php

require_once('includes/template-loader.php');

class BlogController
{
	public function executeHome()
	{
		$sheetsPerPage = 8;

		$sheetManager = new Datasheet();
		$numberOfSheets = $sheetManager->count();

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
	
	public function executeSingle() {
		$commentManager = new Comment();
		if(!empty($_POST['author']) || (empty($_POST['author']) && isset($_SESSION['username']) && !empty($_POST['comment']))) {
			$comment = new Comment();
			$comment->setPostId($_GET['id']);
			if(isset($_SESSION['username'])) {
				$comment->setAuthor($_SESSION['username']);
			} else {
				$comment->setAuthor($_POST['author']);
			}
			$comment->setComment($_POST['comment']);
			$commentManager->add($comment);
			$_SESSION['flash']['success'] = 'Votre commentaire a bien été ajouté.';
		}

		if(isset($_GET['action'])) {
			if($_GET['action'] == 'signal') {
				$comment = $commentManager->getSpecificComment($_GET['commentId']);
				$commentManager->signal($comment);
				$_SESSION['flash']['success'] = 'Le commentaire a bien été signalé. Il sera modéré par l\'administrateur dès que possible.';
			}
		}

		$sheetManager = new Datasheet();
		$sheetUnique = $sheetManager->getUnique($_GET['id']);
		$listOfComments = $commentManager->getSheetComments($_GET['id']);

		return load_template('single.php', array('sheetUnique' => $sheetUnique, 'listOfComments' => $listOfComments));
	}

	public function executeAbout() {
		$aboutManager = new About();
		$aboutDescription = $aboutManager->getAboutDescription();

		return load_template('about.php', array('aboutDescription' => $aboutDescription));
	}

	public function executeMentions() {
		return load_template('mentions.php', array());
	}

	public function executeUsersSpace() {
		return load_template('users.php', array());
	}

	public function executeUserLogin() {
		return load_template('userlogin.php', array());
	}

	public function executeUserRegister() {
		return load_template('register.php', array());
	}
}