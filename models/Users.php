<?php

class Users extends ObjectModel
{	
	private $id;
	private $pseudo;
    private $email;
    private $pass;
    private $register_date;

	public function __construct($value = []) 
	{
		parent::__construct();
		$this->tableName = 'users';
		if(!empty($value)) {
			$this->hydrate($value);
		}
	}
	
	public static function email_taken($email) {
		$db = Database::getDBConnection();
        $mail = array('email' => $email);
        $sql = 'SELECT * FROM users WHERE email = :email';
        $req = $db->prepare($sql);
        $req->execute($mail);
        $free = $req->rowCount($sql);

        return $free;
    }

    public static function register($pseudo, $email, $pass){
        $db = Database::getDBConnection();
        $register = array(
            'pseudo' => $pseudo,
            'email'	 => $email,
            'pass'	 => sha1($pass)
        );
        $sql = "INSERT INTO users(pseudo, email, pass, register_date) VALUES(:pseudo, :email, :pass, NOW())";
        $req = $db->prepare($sql);
        $req->execute($register);
	}
	
	public static function user_login($pseudo, $pass){
        $db = Database::getDBConnection();
        $user = array(
            'pseudo' => $pseudo,
            'pass'   => sha1($pass)
        );
        $sql = "SELECT * FROM users WHERE pseudo = :pseudo AND pass = :pass";
        $req = $db->prepare($sql);
        $req->execute($user);
        $login = $req->rowCount($sql);
		return $login;
	}

	public static function deleteUser()
	{
		$db = Database::getDBConnection();
		$req = $db->prepare("DELETE FROM users WHERE id = ?");
		$req->execute(array($id));
	}

	// SETTERS 
	
	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id
	 */
	public function setId($id) {
		if(is_int($id) && $id > 0) {
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'pseudo'.
	 * @param string $pseudo le pseudo du user
	 */
	public function setPseudo($pseudo) {
		if(is_string($pseudo) && !empty($pseudo)) {
			$this->pseudo = $pseudo;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'email'.
	 * @param string $email email de l'user
	 */
	public function setEmail($email) {
		if(is_string($email) && !empty($email)) {
			$this->email = $email;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'pass'.
	 * @param string $pass le password de l'user
	 */
	public function setPass($pass) {
		if(is_string($pass) && !empty($pass)) {
			$this->pass = $pass;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'register_date'.
	 * @param DateTime $register_date La date d'inscription
	 */
	public function setRegisterDate(DateTime $register_date) {
		$this->register_date = $register_date;
	}

	// GETTERS //
	
	/**
	 * Obtient l'id du commentaire.
	 * @return int L'id du commentaire
	 */
	public function getId() {
		return $this->id; 
	}
   
	/**
	 * Obtient le contenu du pseudo.
	 * @return string Le pseudo
	 */
	public function getPseudo() {
		return $this->pseudo; 
	}

	/**
	 * Obtient le contenu de email.
	 * @return string L'email
	 */
	public function getEmail() {
		return $this->email; 
	}

	/**
	 * Obtient le contenu du password.
	 * @return string Le password
	 */
	public function getPass() {
		return $this->pass; 
	}

	/**
	 * Obtient la date d'inscription.
	 * @return DateTime Object La date d'inscription
	 */
	public function getRegisterDate() {
		return $this->register_date; 
	}
}