<?php

abstract class ObjectModel
{
  // Attribut nécessaire à la connexion avec la base de données.
  public $db;
  public $tableName;

  /**
     * Permet de se connecter à la base de données dès l'instanciation de l'objet.
     * @param PDO Object $db La base de données
     */
  public function __construct()
  {
    $this->db = Database::getDBConnection();
  }

  public function count()
  {
    $query = 'SELECT COUNT(*) FROM ' . $this->tableName;
    $result = $this->db->query($query)->fetchColumn();
    return $result;
  }

  public function hydrate($data)
  {
    foreach ($data as $key => $value) {
      $method = 'set' . ucfirst($key);
      if (method_exists([$this, $method])) {
        $this->$method($value);
      }
    }
  }
}