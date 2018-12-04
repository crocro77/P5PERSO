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

	public function hydrate($data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method]))
			{
				$this->$method($value);
			}
		}
	}

	/**
	 * Obtient la liste des fiches.
	 * @param int $firstSheet La première fiche
	 * @param int $sheetsPerPage Le nombre de fiches par page
	 * @return Sheet objects La liste
	 */
	public static function getList($firstSheet = -1, $sheetsPerPage = -1) 
	{
		$sql = 'SELECT * FROM datasheet ORDER BY title ASC';
		
		// Vérification de la validité des données reçues.
		if($firstSheet != -1 OR $sheetsPerPage != -1)
		{
			$sql .= ' LIMIT ' . (int) $sheetsPerPage . ' OFFSET ' . (int) $firstSheet;
		}
		$db = Database::getDBConnection();
		$request = $db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Datasheet');
		$listOfSheets = $request->fetchAll();
		// On boucle sur la liste des chapitres afin d'instancier des objets Date pour date
		foreach($listOfSheets as $sheet)
		{
			$sheet->setDate(new DateTime($sheet->getDate()));
		}
		$request->closeCursor();
		return $listOfSheets;
	}

		/**
	 * Obtient un chapitre unique (pour la vue Single)
	 * @param int $id L'id du chapitre
	 * @return chapter l'objet chapitre
	 */
	public static function getUnique($id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('SELECT * FROM datasheet WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Datasheet');
		$chapter = $request->fetch();
		if($chapter === false) {
			header("Location:index.php");
		}
		$chapter->setDate(new DateTime($chapter->getDate()));
		return $chapter;
	}

		/**
	 * Ajoute une fiche dans la base de données.
	 * @param chapter $chapter L'objet chapitre
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
		$req->bindValue(':cover', $sheet->getCover() ? $sheet->getCover() : 'cover.png');
		$req->bindValue(':screenshot', $sheet->getScreenshot() ? $sheet->getScreenshot() : 'screenshot.png');
		$req->bindValue(':track', $sheet->getTrack() ? $sheet->getTrack() : 'track.mp3');
		$req->bindValue(':trackname', $sheet->getTrackName() ? $sheet->getTrackName() : 'SEGA');
		$req->execute();
	}

	/**
	 * Met à jour les valeurs d'un chapitre.
	 * @param string $title Le titre
	 * @param string $author L'auteur
	 * @param string $content Le contenu
	 * @param string $developer Le developpeur
	 * @param string $publisher L'editeur
	 * @param int $release_date La date de sortie
	 * @param string $genre le genre
	 * @param int $id L'id
	 */
	public static function updateSheet($title, $author, $content, $developer, $publisher, $release_date, $genre, $trackname, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE datasheet SET title = :title, author = :author, content = :content, developer = :developer, publisher = :publisher, release_date = :release_date, genre = :genre, trackname = :trackname, date = NOW() WHERE id = :id');
		$request->bindValue(':title', $title);
		$request->bindValue(':author', $author);
		$request->bindValue(':content', $content);
		$request->bindValue(':developer', $developer);
		$request->bindValue(':publisher', $publisher);
		$request->bindValue(':release_date', (int) $release_date);
		$request->bindValue(':genre', $genre);
		$request->bindValue(':trackname', $trackname);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	/**
	 * Met à jour de la cover de la fiche.
	 * @param string $cover La cover
	 */
	public static function updateCover($cover, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE datasheet SET cover = :cover WHERE id = :id');
		$request->bindValue(':cover', $cover);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	/**
	 * Met à jour du screenshot d'une fiche.
	 * @param string $screenshot Le screenshot
	 */
	public static function updateScreenshot($screenshot, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE datasheet SET screenshot = :screenshot WHERE id = :id');
		$request->bindValue(':screenshot', $screenshot);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

	/**
	 * Met à jour l'image d'un chapitre.
	 * @param string $screenshot L'image
	 */
	public static function updateTrack($track, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE datasheet SET track = :track WHERE id = :id');
		$request->bindValue(':track', $track);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}

		/**
	 * Met à jour l'image d'un chapitre.
	 * @param string $screenshot L'image
	 */
	public static function updateTrackName($trackname, $id)
	{
		$db = Database::getDBConnection();
		$request = $db->prepare('UPDATE datasheet SET trackname = :trackname WHERE id = :id');
		$request->bindValue(':trackname', $trackname);
		$request->bindValue(':id', (int) $id);
		$request->execute();
	}
	
	/**
	 * Supprime un chapitre de la bdd
	 */
	public static function deleteSheet()
	{
		$db = Database::getDBConnection();
		$db->exec('DELETE FROM datasheet WHERE id = '. $_POST['id']);
	}

		/**
	 * Supprime tous les articles de la base de données. Remet l'id de base à 0.
	 */
	public static function deleteAll()
	{
		$db = Database::getDBConnection();
		$result = $db->exec('TRUNCATE TABLE datasheet');
		return $result;
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
		if(is_string($title) && !empty($title)) {
			$this->title = $title;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'content'.
	 * @param string $content Le contenu
	 */
	public function setContent($content)
	{
		if(is_string($content) && !empty($content)) 
		{
			$this->content = $content;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'developer'.
	 * @param string $developer Le developer
	 */
	public function setDeveloper($developer)
	{
		if(is_string($developer) && !empty($developer)) 
		{
			$this->developer = $developer;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'publisher'.
	 * @param string $publisher Le publisher
	 */
	public function setPublisher($publisher)
	{
		if(is_string($publisher) && !empty($publisher)) 
		{
			$this->publisher = $publisher;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'release_date'.
	 * @param int $date La date de release
	 */
	public function setReleaseDate($release_date)
	{
		$this->release_date = $release_date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'genre'.
	 * @param string $genre Le genre
	 */
	public function setGenre($genre)
	{
		if(is_string($genre) && !empty($genre)) 
		{
			$this->genre = $genre;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'cover'.
	 * @param string $cover L'image cover de la fiche
	 */
	public function setCover($cover)
	{
		if(is_string($cover) && !empty($cover)) 
		{
			$this->cover = $cover;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'screenshot'.
	 * @param string $screenshot L'image screenshot de la fiche
	 */
	public function setScreenshot($screenshot)
	{
		if(is_string($screenshot) && !empty($screenshot)) 
		{
			$this->screenshot = $screenshot;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $author l'auteur
	 */
	public function setAuthor($author)
	{
		if(is_string($author) && !empty($author)) 
		{
			$this->author = $author;
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
		if(is_string($track) && !empty($track)) 
		{
			$this->track = $track;
		}
	}

		/**
	 * Permet d'assigner une valeur à l'attribut 'trackname'.
	 * @param string $track le nom de la track sample
	 */
	public function setTrackName($trackname)
	{
		if(is_string($trackname) && !empty($trackname)) 
		{
			$this->trackname = $trackname;
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