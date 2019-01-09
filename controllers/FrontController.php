<?php

require_once('includes/template-loader.php');

class FrontController
{
	public function executeHome()
	{
		if(isset($_GET['pp']) && (!empty($$_GET['pp']) && ctype_digit($_GET['pp']) == 1 )) {
			$sheetsPerPage = $_GET['pp'];
		} else {
			$sheetsPerPage = 8;
		}

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

		return load_template('front/home.php', array('listOfSheets' => $listOfSheets, 'numberOfPages' => $numberOfPages, 'currentPage' => $currentPage));
	}
	
	public function executeSingleSheet()
    {
		if(isset($_GET['id'])) {
			$sheetManager = new Datasheet();
			$sheetUnique = $sheetManager->getUnique($_GET['id']);
			$commentManager = new Comment();
			$listOfComments = $commentManager->getSheetComments($_GET['id']);
	
			return load_template('front/single.php', array('sheetUnique' => $sheetUnique, 'listOfComments' => $listOfComments));
		}
    }

    public function executeCommentSheet()
    {
		if(isset($_GET['id'])) {
			if(!empty($_POST['author']) || (empty($_POST['author']) && isset($_SESSION['username']) && !empty($_POST['comment']))) {
				$comment = new Comment();
				$comment->setPostId($_GET['id']);
				if(isset($_SESSION['username'])) {
					$comment->setAuthor($_SESSION['username']);
				} else {
					$comment->setAuthor($_POST['author']);
				}
				$comment->setComment($_POST['comment']);
				$commentManager = new Comment();
				$commentManager->add($comment);
				header('Location: index.php?p=single&id='.($_GET['id']).'#comments');
			}
		}
    }

    public function executeSignalComment($commentId)
    {    
		if(isset($_GET['id'])) {
			$commentManager = new Comment();
			$comment = $commentManager->getSpecificComment($_GET['commentId']);
			$commentManager->signal($comment);
			header('Location: index.php?p=single&id='.($_GET['id']).'#comments');
		}
	}

	public function executeMentions() {
		return load_template('front/mentions.php', array());
	}
}