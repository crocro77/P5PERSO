<?php

class Database 
{
	private $db;
	private $db_host;
	private $db_name;
	private $db_user;
	private $db_pass;

	public function __construct() {
		$this->db_host = 'localhost';
		$this->db_name = 'gamegear';
		$this->db_user = 'root';
		$this->db_pass = '';
		$this->db = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name . ';charset=utf8', $this->db_user, $this->db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	public function getDBConnection() {
		return $this->db;
	}

	// public static function getDBConnection() {
	// 	return self::$db;
	// }
}
