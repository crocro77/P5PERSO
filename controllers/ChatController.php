<?php

class ChatController extends Controller
{
	public function __construct()
	{
		if(!isset($_SESSION['username'])) {
			header('Location: index.php?p=user');
			exit();
		}
	}

	public function executeChat()
	{
		$chatManager = new Chat();
		$listOfChatMessages = $chatManager->getChatMessages();
		
		// return load_template('front/chat.php', array('listOfChatMessages' => $listOfChatMessages));
		echo $this->twig->render('front/chat.twig', ['chat' => Chat::getChatMessages(), 'listOfChatMessages' => $listOfChatMessages ]);
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
        }
	}

	public function executeUpdateChat()
	{
		$chatMessage = new Chat();
		$var = ['pseudo' => $chatMessage->setPseudo($_POST['pseudo']), 'message' => $chatMessage->setMessage($_POST['message'])];
		echo json_encode($var);
	}
}