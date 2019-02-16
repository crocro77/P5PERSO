<?php

class ChatController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['username'])) {
			header('Location: user');
			exit();
		}
	}

	public function executeChat()
	{
		$chatManager = new Chat();
		$listOfChatMessages = $chatManager->getChatMessages();
		
		echo $this->twig->render('front/chat.twig',
			[
				'chat' => Chat::getChatMessages(), 
				'listOfChatMessages' => $listOfChatMessages
			]);
	}
	
	public function executeAddMessage()
	{
		if(!empty($_POST['pseudo']) && !empty($_POST['message'])) {
			$chatMessage = new Chat();
			if(isset($_SESSION['username'])) {
				$chatMessage->setPseudo($_SESSION['username']);
			} else {
				$chatMessage->setPseudo($_POST['pseudo']);
			}
			$chatMessage->setMessage($_POST['message']);
			$chatMessage->addChatMessage();
			header('Location: '.generateURL('chat'));
        }
	}

	public function executeUpdateChat()
	{
		$chatMessage = new Chat();
		$listOfNewMessages = $chatMessage->getNewMessages($_GET['id']);
		$messages = [];
		foreach ($listOfNewMessages as $key => $message) {
			$messages[$key]['id'] = $message->getId();
			$messages[$key]['pseudo'] = $message->getPseudo();
			$messages[$key]['message'] = $message->getMessage();
		}  
		echo json_encode($messages);
	}
}