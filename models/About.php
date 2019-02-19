<?php

class About extends ObjectModel {
	
	private $id;
	private $description;

	public function __construct($value = []) {
        parent::__construct();
		$this->tableName = 'about';
		if(!empty($value)) {
			$this->hydrate($value);
		}
	}
    
    /**
	 * Permet d'ajouter un objet About (description) en base de données.
	 * @param string $about L'objet About
	 */
    public function addAbout(){
        $db = Database::getDBConnection();
		$req = $db->prepare('INSERT INTO about (description) VALUES (:description)');
		$req->bindValue(':description', $this->getDescription());
		$req->execute();
	}

	/**
	 * Obtient la description pour affichage en vue.
	 * @return string La description.
	 */
	public static function getAboutDescription() {
        $db = Database::getDBConnection();
		$res = $db->query('SELECT * FROM about WHERE id = 1')->fetchColumn(1);
		return $res;
	}

	/**
	 * Supprime la description
	 */
	public static function deleteDescription() {
        $db = Database::getDBConnection();
		$res = $db->exec('TRUNCATE TABLE about');
		return $res;
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
	 * Permet d'assigner une valeur à l'attribut 'description'.
	 * @param string $description La description.
	 */
	public function setDescription($description) {
		if(is_string($description) AND !empty($description) && strlen($description) < 255) {
			$this->description = $description;
		} else {
			$this->description = '';
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
	 * Obtient la valeur de l'attribut 'description'.
	 * @return string La description.
	 */
	public function getDescription() {
		return $this->description;
	}
}