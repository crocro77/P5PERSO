<?php

class Datasheet extends ObjectModel
{
	private $id;
	private $title;
	private $content;
	private $developer;
	private $publisher;
	private $release_date;
	private $genre;
	private $cover;
	private $screenshot;
	private $author;
	private $date;
	private $track;
	private $trackname;

	public function __construct($value = [])
	{
		parent::__construct();
		$this->tableName = 'datasheet';
		if(!empty($value))
		{
			$this->hydrate($value);
		}
	}

	/**
	 * Obtient la liste des fiches par ordre alphabétique.
	 * @return Sheet objects La liste
	 */
	public static function getListAlpha() 
	{
		$char = '';  
		if(isset($_GET["char"]))  
		{  
			$char = $_GET["char"];  
			$char = preg_replace('#[^a-z]#i', '', $char);  
			$sql = "SELECT * FROM datasheet WHERE title LIKE '$char%' ORDER BY title ASC";  
		}  
		else  
		{  
			$sql = "SELECT * FROM datasheet ORDER BY title ASC";  
		} 
		$db = Database::getDBConnection();
		$request = $db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Datasheet');
		$listOfSheets = $request->fetchAll();
		foreach($listOfSheets as $sheet)
		{
			$sheet->setDate(new DateTime($sheet->getDate()));
		}
		$request->closeCursor();
		return $listOfSheets;
	}

	/**
	 * Obtient une fich unique (pour la vue Single)
	 * @param int $id L'id de la fiche
	 * @return sheet l'objet fiche
	 */
	public static function getUnique($id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('SELECT * FROM datasheet WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Datasheet');
		$sheet = $request->fetch();
		if($sheet === false) {
			header('Location:' .generateURL('error'));
		}
		$sheet->setDate(new DateTime($sheet->getDate()));
		return $sheet;
	}

	/**
	 * Ajoute une fiche dans la base de données.
	 * @param sheet $sheet L'objet fiche
	 */
	public static function addSheet(Datasheet $sheet)
	{
		$db = Database::getDBConnection();
		$req = $db->prepare('INSERT INTO datasheet(title, content, author, developer, publisher, release_date, genre, cover, screenshot, track, trackname, date) VALUES(:title, :content, :author, :developer, :publisher, :release_date, :genre, :cover, :screenshot, :track, :trackname, NOW())');
		$req->bindValue(':title', $sheet->getTitle());
		$req->bindValue(':content', $sheet->getContent());
		$req->bindValue(':author', $sheet->getAuthor());
		$req->bindValue(':developer', $sheet->getDeveloper());
		$req->bindValue(':publisher', $sheet->getPublisher());
		$req->bindValue(':release_date', $sheet->getReleaseDate());
		$req->bindValue(':genre', $sheet->getGenre());
		$req->bindValue(':cover', $sheet->getCover());
		$req->bindValue(':screenshot', $sheet->getScreenshot());
		$req->bindValue(':track', $sheet->getTrack());
		$req->bindValue(':trackname', $sheet->getTrackName() ? $sheet->getTrackName() : 'SEGA');
		$req->execute();
	}

	/**
	 * Met à jour les valeurs d'une fiche.
	 * @param string $title Le titre
	 * @param string $author L'auteur
	 * @param string $content Le contenu
	 * @param string $developer Le developpeur
	 * @param string $publisher L'editeur
	 * @param int $release_date La date de sortie
	 * @param string $genre le genre
	 * @param string $cover la cover
	 * @param string $screenshot le screenshot
	 * @param string $track la track
	 * @param string $trackname le nom de la track
	 * @param int $id L'id
	 */
	public function updateSheet()
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE datasheet SET title = :title, author = :author, content = :content, developer = :developer, publisher = :publisher, release_date = :release_date, genre = :genre,  cover = :cover, screenshot = :screenshot, track = :track, trackname = :trackname, date = NOW() WHERE id = :id');
		$request->bindValue(':title', $this->getTitle());
		$request->bindValue(':author', $this->getAuthor());
		$request->bindValue(':content', $this->getContent());
		$request->bindValue(':developer', $this->getDeveloper());
		$request->bindValue(':publisher', $this->getPublisher());
		$request->bindValue(':release_date', (int) $this->getReleaseDate());
		$request->bindValue(':genre', $this->getGenre());
		$request->bindValue(':cover', $this->getCover());
		$request->bindValue(':screenshot', $this->getScreenshot());
		$request->bindValue(':track', $this->getTrack());
		$request->bindValue(':trackname', $this->getTrackName());
		$request->bindValue(':id', (int) $this->getId());
		$request->execute();
	}
	
	/**
	 * Supprime une fiche de la bdd
	 */
	public static function deleteSheet()
	{
		$db = Database::getDBConnection();
		$db->exec('DELETE FROM datasheet WHERE id = '. $_POST['id']);
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
	 * Permet d'assigner une valeur à l'attribut 'title'.
	 * @param string $title Le titre
	 */
	public function setTitle($title)
	{
		if(is_string($title) && !empty($title) && strlen($title) < 255)
		{
			$this->title = $title;
		} else {
			$this->title = '';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'content'.
	 * @param string $content Le contenu
	 */
	public function setContent($content)
	{
		if(is_string($content) && !empty($content) && strlen($content) < 65535) 
		{
			$this->content = $content;
		} else {
			$this->content = '';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'developer'.
	 * @param string $developer Le developer
	 */
	public function setDeveloper($developer)
	{
		if(is_string($developer) && !empty($developer) && strlen($developer) < 255) 
		{
			$this->developer = $developer;
		} else {
			$this->developer = '';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'publisher'.
	 * @param string $publisher Le publisher
	 */
	public function setPublisher($publisher)
	{
		if(is_string($publisher) && !empty($publisher) && strlen($publisher) < 255) 
		{
			$this->publisher = $publisher;
		} else {
			$this->publisher = '';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'release_date'.
	 * @param int $date La date de release
	 */
	public function setReleaseDate($release_date)
	{
		$this->release_date = (int) $release_date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'genre'.
	 * @param string $genre Le genre
	 */
	public function setGenre($genre)
	{
		if(is_string($genre) && !empty($genre) && strlen($genre) < 255) 
		{
			$this->genre = $genre;
		} else {
			$this->genre = '';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'cover'.
	 * @param string $cover L'image cover de la fiche
	 */
	public function setCover($cover)
	{
		if(is_string($cover) && !empty($cover) && strlen($cover) < 255) 
		{
			$this->cover = $cover;
		} else {
			$this->cover = 'cover.png';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'screenshot'.
	 * @param string $screenshot L'image screenshot de la fiche
	 */
	public function setScreenshot($screenshot)
	{
		if(is_string($screenshot) && !empty($screenshot) && strlen($screenshot) < 255) 
		{
			$this->screenshot = $screenshot;
		} else {
			$this->screenshot = 'screenshot.png';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $author l'auteur
	 */
	public function setAuthor($author)
	{
		if(is_string($author) && !empty($author) && strlen($author) < 255) 
		{
			$this->author = $author;
		} else {
			$this->author = '';
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'date'.
	 * @param DateTime $date La date de publication
	 */
	public function setDate(DateTime $date)
	{
		$this->date = $date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'track'.
	 * @param string $track une track sample
	 */
	public function setTrack($track)
	{
		if(is_string($track) && !empty($track) && strlen($track) < 255) 
		{
			$this->track = $track;
		} else {
			$this->track = 'track.mp3';
		}
	}

		/**
	 * Permet d'assigner une valeur à l'attribut 'trackname'.
	 * @param string $track le nom de la track sample
	 */
	public function setTrackName($trackname)
	{
		if(is_string($trackname) && !empty($trackname) && strlen($trackname) < 255) 
		{
			$this->trackname = $trackname;
		} else {
			$this->trackname = 'SEGA';
		}
	}
	
	// GETTERS

	/**
	 * Obtient l'id de la fiche.
	 * @return int L'id
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient le titre de la fiche.
	 * @return string Le titre
	 */
	public function getTitle() {
		return $this->title; 
	}

	/**
	 * Obtient le contenu de la fiche.
	 * @return string Le contenu
	 */
	public function getContent() {
		return $this->content; 
	}

	/**
	 * Obtient le developer de la fiche.
	 * @return string le developer
	 */
	public function getDeveloper() {
		return $this->developer;
	}

	/**
	 * Obtient le publisher de la fiche.
	 * @return string le publiser
	 */
	public function getPublisher() {
		return $this->publisher;
	}

	/**
	 * Obtient la release_date de la fiche
	 * @return Year Object La release_date
	 */
	public function getReleaseDate() {
		return $this->release_date; 
	}

	/**
	 * Obtient le genre de la fiche.
	 * @return string le genre
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * Obtient l'image cover de la fiche.
	 * @return string l'image cover de la fiche
	 */
	public function getCover() {
		return $this->cover;
	}

	/**
	 * Obtient l'image screenshot de la fiche.
	 * @return string l'image screenshot de la fiche
	 */
	public function getScreenshot() {
		return $this->screenshot;
	}

	/**
	 * Obtient l'auteur de la fiche.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
	}

	/**
	 * Obtient la date de publication de la fiche.
	 * @return DateTime Object La date de publication
	 */
	public function getDate() {
		return $this->date; 
	}

	/**
	 * Obtient la track de la fiche.
	 * @return string La track
	 */
	public function getTrack() {
		return $this->track; 
	}

	/**
	 * Obtient la trackname de la fiche.
	 * @return string La trackname
	 */
	public function getTrackName() {
		return $this->trackname; 
	}
}