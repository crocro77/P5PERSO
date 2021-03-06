<?php

class Chat extends ObjectModel
{	
	private $id;
	private $pseudo;
	private $message;

	public function __construct($value = []) 
	{
		parent::__construct();
		$this->tableName = 'chat';
		if(!empty($value)) {
			$this->hydrate($value);
		}
	}

    // Récupération des messages du chat
    public static function getChatMessages()
    {
        $db = Database::getDBConnection();
        $request = $db->query('SELECT pseudo, message, id FROM chat ORDER BY id ASC');
        $request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Chat');
        $listOfChatMessages = $request->fetchAll();
        return $listOfChatMessages;
	}
	
	public static function getNewMessages($id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('SELECT pseudo, message, id FROM chat WHERE id > :id ORDER BY id ASC');
		$request->bindValue(':id', (int) $id);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Chat');
		$request->execute();
        $listOfNewMessages = $request->fetchAll();
        return $listOfNewMessages;
	}

    // Insertion du message
    public static function addChatMessage()
    {
        $db = Database::getDBConnection();
        $request = $db->prepare('INSERT INTO chat (pseudo, message) VALUES(?, ?)');
        $request->execute(array($_POST['pseudo'], $_POST['message']));
	}
	
    // SETTERS //

	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id.
	 */
	public function setId($id) {
		if($id > 0) {
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'pseudo'.
	 * @param string $pseudo Le pseudo.
	 */
	public function setPseudo($pseudo) {
		if(is_string($pseudo) AND !empty($pseudo) && strlen($pseudo) < 255) {
			$this->pseudo = $pseudo;
		} else {
			$this->pseudo = '';
		}
    }
    
	/**
	 * Permet d'assigner une valeur à l'attribut 'message'.
	 * @param string $message Le message.
	 */
	public function setMessage($message) {
		if(is_string($message) AND !empty($message) && strlen($message) < 256) {
			$this->message = $message;
		} else {
			$this->message = '';
		}
	}

	// GETTERS //

	/**
	 * Obtient la valeur de l'attribut 'id'.
	 * @return int L'id.
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Obtient la valeur de l'attribut 'pseudo'.
	 * @return string Le pseudo.
	 */
	public function getPseudo() {
		return $this->pseudo;
    }
    
	/**
	 * Obtient la valeur de l'attribut 'messag'.
	 * @return string Le message.
	 */
	public function getMessage() {
		return $this->message;
	}
}