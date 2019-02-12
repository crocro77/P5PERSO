<?php

class FrontController extends Controller
{
	public function executeHome()
	{
		$sheetManager = new Datasheet();
		$listOfSheets = $sheetManager->getListAlpha();

		echo $this->twig->render('front/home.twig', ['datasheet' => Datasheet::getListAlpha(), ]);
	}
	
	public function executeSingleSheet()
    {
		if(isset($_GET['id'])) {
			$sheetManager = new Datasheet();
			$sheetUnique = $sheetManager->getUnique($_GET['id']);
			$commentManager = new Comment();
			$listOfComments = $commentManager->getSheetComments($_GET['id']);
	
			echo $this->twig->render('front/single.twig', ['sheetUnique' => Datasheet::getUnique($_GET['id']), 'listOfComments' => $listOfComments, 'comment' => Comment::getSheetComments($_GET['id'])]);
		}
    }

    public function executeCommentSheet()
    {
			if(!empty($_POST['author']) || (empty($_POST['author']) && isset($_SESSION['username']) && !empty($_POST['comment']))) {
				$comment = new Comment();
				$comment->setPostId($_POST['id']);
				if(isset($_SESSION['username'])) {
					$comment->setAuthor($_SESSION['username']);
				} else {
					$comment->setAuthor($_POST['author']);
				}
				$comment->setComment($_POST['comment']);
				$commentManager = new Comment();
				$commentManager->add($comment);
				header('Location: '.generateURL('game/sheet?id='.$_POST['id'].'#comments'));
			}
    }

    public function executeSignalComment()
    {    
		if(isset($_GET['id'])) {
			$commentManager = new Comment();
			$comment = $commentManager->getSpecificComment($_GET['commentId']);
			$commentManager->signal($comment);
			header('Location: '.generateURL('game/sheet?id='.$_POST['commentId'].'#comments'));
		}
	}

	public function executeMentions() {
		echo $this->twig->render('front/mentions.twig');
	}
}