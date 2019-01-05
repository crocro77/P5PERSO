<?php

require_once('includes/template-loader.php');

class ChatController
{
    public function executeChat() {
		$chatManager = new Chat();
        $listOfChatMessages = $chatManager->getChatMessages();

        if(!empty($_POST['pseudo']) && !empty($_POST['message'])) {
			$chatMessage = new Chat();
			if(isset($_SESSION['username'])) {
				$chatMessage->setPseudo($_SESSION['username']);
			} else {
				$chatMessage->setPseudo($_POST['pseudo']);
			}
			$chatMessage->setMessage($_POST['message']);
            $chatManager->addChatMessage();
        }


		return load_template('front/chat.php', array('listOfChatMessages' => $listOfChatMessages));
    }
}