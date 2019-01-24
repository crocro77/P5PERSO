<?php

class Admin extends ObjectModel
{
    private $id;
	private $username;
    private $password;
    
    public function __construct($value = [])
	{
		parent::__construct();
		$this->tableName = 'admin';
		if(!empty($value))
		{
			$this->hydrate($value);
		}
    }

    public static function isAdmin($username,$password)
    {
        $db = Database::getDBConnection();
        $admin = [
            'username'     =>  $username,
            'password'     =>  sha1($password)
        ];
        $sql = "SELECT * FROM admin WHERE username = :username AND password = :password";
        $req = $db->prepare($sql);
        $req->execute($admin);
        $exist = $req->rowCount($sql);
        return $exist;
    }

    // SETTERS

	/**
	 * Permet d'assigner une valeur à l'attribut 'id'.
	 * @param int $id L'id
	 */
	public function setId($id)
	{
		if(is_int($id) && $id > 0)
		{
			$this->id = $id;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'username'.
	 * @param string $username Le nom d'utilisateur
	 */
	public function setUsername($username)
	{
		if(is_string($username) && !empty($username) && strlen($username) < 50)
		{
			$this->username = $username;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'password'.
	 * @param string $password Le mot de passe
	 */
	public function setPassword($password)
	{
		if(is_string($password) && !empty($password) && strlen($password) < 255) 
		{
			$this->password = $password;
		}
    }

    // GETTERS

	/**
	 * Obtient l'id de admin.
	 * @return int L'id
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient le nom d'utilisateur de l'admin.
	 * @return string Le username
	 */
	public function getUsername() {
		return $this->username; 
	}

	/**
	 * Obtient le password de l'admin.
	 * @return string Le password
	 */
	public function getPassword() {
		return $this->password; 
	}
    
}