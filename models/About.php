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

	public function hydrate($data) {
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method])) {
				$this->$method($value);
			}
		}
    }
    
    /**
	 * Permet d'ajouter un objet About (description) en base de données.
	 * @param string $about L'objet About
	 */
    public static function add(About $about) {
        $db = Database::getDBConnection();
		$req = $db->prepare('INSERT INTO about (description) VALUES (:description)');
		$req->bindValue(':description', $about->getDescription());
		
		$req->execute();
	}

	/**
	 * Permet de mettre à jour la valeur de l'objet About en base de données.
	 * @param string $about L'objet About
	 */
	public function update($description, $id) {
        $db = Database::getDBConnection();
		$req = $db->prepare('UPDATE about SET description = :description WHERE id = :id');
		$req->bindValue(':description', $description);
		$req->bindValue(':id', (int) $id);
		$req->execute();
	}

	/**
	 * Obtient la description pour affichage en vue.
	 * @return string La description.
	 */
	public function getAboutDescription() {
        $db = Database::getDBConnection();
		$res = $db->query('SELECT * FROM about WHERE id = 1')->fetchColumn(1);
		return $res;
	}

	public function deleteDescription() {
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
		if(is_string($description) AND !empty($description)) {
			$this->description = $description;
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