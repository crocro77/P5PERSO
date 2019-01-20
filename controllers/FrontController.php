<?php

// namespace App\Controller;

// require_once("models/Datasheet.php");

// use \App\Model\Datasheet;

require_once('includes/template-loader.php');

class FrontController
{
	public function executeHome()
	{
		$sheetManager = new Datasheet();
		$listOfSheets = $sheetManager->getListAlpha();

		return load_template('front/home.php', array('listOfSheets' => $listOfSheets));
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