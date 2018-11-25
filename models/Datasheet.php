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
	 * Obtient la liste des chapitres.
	 * @param int $firstArticle Le premier chapitre
	 * @param int $chaptersPerPage Le nombre de chapitres par page
	 * @return Sheet objects La liste
	 */
	public function getList($firstSheet = -1, $sheetsPerPage = -1) 
	{
		$sql = 'SELECT * FROM datasheet ORDER BY title DESC';
		
		// Vérification de la validité des données reçues.
		if($firstSheet != -1 OR $sheetsPerPage != -1)
		{
			$sql .= ' LIMIT ' . (int) $sheetsPerPage . ' OFFSET ' . (int) $firstSheet;
		}
		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Sheet');
		$listOfSheets = $request->fetchAll();
		// On boucle sur la liste des chapitres afin d'instancier des objets Date pour date
		foreach($listOfSheets as $sheet)
		{
			$sheet->setReleaseDate(new Year($sheet->getReleaseDate()));
		}
		$request->closeCursor();
		return $listOfSheets;
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
	 * @param string $developer Le contenu
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
	 * @param string $publisher Le contenu
	 */
	public function setPublisher($publisher)
	{
		if(is_string($publisher) && !empty($publisher)) 
		{
			$this->publisher = $publisher;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'date'.
	 * @param Year $date La date de publication
	 */
	public function setReleaseDate(Year $release_date)
	{
		$this->release_date = $release_date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'genre'.
	 * @param string $genre Le contenu
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
	 * @param string $cover L'image d'illustration du chapitre
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
	 * @param string $screenshot L'image d'illustration du chapitre
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
	
	// GETTERS

	/**
	 * Obtient l'id du chapter.
	 * @return int L'id
	 */
	public function getId() {
		return $this->id; 
	}

	/**
	 * Obtient le titre du chapter.
	 * @return string Le titre
	 */
	public function getTitle() {
		return $this->title; 
	}

	/**
	 * Obtient le contenu du chapter.
	 * @return string Le contenu
	 */
	public function getContent() {
		return $this->content; 
	}

	/**
	 * Obtient l'image du chapitres.
	 * @return string l'image du chapitre
	 */
	public function getDeveloper() {
		return $this->developer;
	}

	/**
	 * Obtient l'image du chapitres.
	 * @return string l'image du chapitre
	 */
	public function getPublisher() {
		return $this->publisher;
	}

	/**
	 * Obtient la date de publication du chapter.
	 * @return Year Object La date de publication
	 */
	public function getReleaseDate() {
		return $this->release_date; 
	}

	/**
	 * Obtient l'image du chapitres.
	 * @return string l'image du chapitre
	 */
	public function getGenre() {
		return $this->genre;
	}

	/**
	 * Obtient l'image du chapitres.
	 * @return string l'image du chapitre
	 */
	public function getCover() {
		return $this->cover;
	}

	/**
	 * Obtient l'image du chapitres.
	 * @return string l'image du chapitre
	 */
	public function getScreenshot() {
		return $this->screenshot;
	}

	/**
	 * Obtient l'auteur du chapter.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
	}
}