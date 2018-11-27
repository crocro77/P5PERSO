<?php

class Comment extends ObjectModel
{	
	private $id;
	private $post_id;
	private $comment;
	private $comment_date;
	private $author;
	private $signaled;
	private $seen;

	public function __construct($value = []) 
	{
		parent::__construct();
		$this->tableName = 'comments';
		if(!empty($value)) {
			$this->hydrate($value);
		}
	}

	public function hydrate($data)
	{
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method])) {
				$this->$method($value);
			}
		}
	}

	/**
	 * Obtient les commentaires d'un chapitre spécifique
	 * @param id $chapterId L'id du chapitre
	 * @return Comment objet Les commentaires.
	 */
	public static function getSheetComments($post_id) {
		$db = Database::getDBConnection();
		$request = $db->prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC');
		$request->bindValue(':post_id', $post_id);
		$request->execute();
		$listComments = $request->fetchAll(PDO::FETCH_CLASS, "Comment");
		$request->closeCursor();
		return $listComments;
	}

	/**
	 * Obtient un commentaire spécifique.
	 * @param int $id L'id du commentaire
	 * @return Comment Object Le commentaire.
	 */
	public static function getSpecificComment($id) {
		$db = Database::getDBConnection();
		$request = $db->prepare('SELECT * FROM comments WHERE id = :id');
		$request->bindValue(':id', (int) $id);
		$request->execute();
		$request->setFetchMode(PDO::FETCH_CLASS, "Comment");
		$comment = $request->fetch();
		$request->closeCursor();
		return $comment;
	}

		/**
	 * Ajoute un commentaire en base de données.
	 * @param Comment $comment Le commentaire
	 */
	public static function add(Comment $comment) {
		$db = Database::getDBConnection();
		$req = $db->prepare('INSERT INTO comments (post_id, author, comment, comment_date) VALUES(:post_id, :author, :comment, NOW())');
		$req->bindValue(':post_id', $comment->getPostId());
		$req->bindValue(':author', $comment->getAuthor());
		$req->bindValue(':comment', $comment->getComment());
		$req->execute();
	}

	/**
	 * Obtient tous les commentaires, triés par id du chapitre et date de publication.
	 * @return Comment objet Les commentaires.
	 */
	public static function getAllComments() {
		$db = Database::getDBConnection();
		$result = $db->query("SELECT comments.id, comments.author, comments.comment_date, comments.post_id, comments.comment, posts.title FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.seen = '0' ORDER BY comments.post_id, comments.comment_date ASC");
		$listComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");
		foreach($listComments as $comment) {
			$comment->setCommentDate(new DateTime($comment->getCommentDate()));
		}
		return $listComments;
	}

	/**
	 * obtenir le commentaire signalé
	 * @return le commentaire signalé.
	 */
	public static function getSignaledComments() {
		$db = Database::getDBConnection();
		$result = $db->query('SELECT * FROM comments WHERE signaled > 0 ORDER BY signaled DESC');
		$signaledComments = $result->fetchAll(PDO::FETCH_CLASS, "Comment");
		foreach($signaledComments as $comment) {
			$comment->setCommentDate(new DateTime($comment->getCommentDate()));
		}
		return $signaledComments;
	}

	/**
	 * Signaler un commentaire
	 * @param $comment  The comment
	 */
	public static function signal($comment) {
		$db = Database::getDBConnection();
		$req = $db->prepare('UPDATE comments SET signaled = 1  WHERE id = :id ');
		$req->bindValue(':id', (int) $comment->getId());
		$req->execute();
	}

	/**
	 * Valider un commentaire
	 * @param int $commentId The comment identifier
	 */
	public static function validateComment($commentId) {
		$db = Database::getDBConnection();
		$req = $db->prepare('UPDATE comments SET signaled = 0, seen = 1 WHERE id = :id');
		$req->bindValue(':id', (int) $commentId);
		$req->execute();
	}

	/**
	 * Indiqué comme vu un commentaire
	 * @param int $commentId 
	 */
	public static function seenComment($commentId) {
		$db = Database::getDBConnection();
		$req = $db->prepare('UPDATE comments SET seen = 1 WHERE id = :id');
		$req->bindValue(':id', (int) $commentId);
		$req->execute();
	}

	/**
	 * supprime un commentaire
	 * @param int $id l'identifiant
	 */
	public function deleteComment($commentId) {
		$db = Database::getDBConnection();
		$req = $db->prepare('DELETE FROM comments WHERE id = :id');
		$req->bindValue(':id', $commentId);
		$req->execute();
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
	 * Permet d'assigner une valeur à l'attribut 'post_id'.
	 * @param int $post_id L'id du chapter
	 */
	public function setPostId($post_id) {
		$this->post_id = (int) $post_id;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'comment'.
	 * @param string $comment Le commentaire
	 */
	public function setComment($comment) {
		if(is_string($comment) && !empty($comment)) {
			$this->comment = $comment;
		}
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'comment_date'.
	 * @param DateTime $comment_date La date de publication
	 */
	public function setCommentDate(DateTime $comment_date) {
		$this->comment_date = $comment_date;
	}

	/**
	 * Permet d'assigner une valeur à l'attribut 'author'.
	 * @param string $author L'auteur
	 */
	public function setAuthor($author) {
		if(is_string($author) && !empty($author)) {
			$this->author = $author;
		}
	}
    
	/**
	 * Permet d'assigner une valeur à l'attribut 'signaled'.
	 * @param int $signaled Le signal
	 */
	public function setSignaled($signaled) {
		if(is_int($signaled) && !empty($signaled)) {
			$this->signaled = $signaled;
		}
	}

		/**
	 * Permet d'assigner une valeur à l'attribut 'signaled'.
	 * @param int $signaled Le signal
	 */
	public function setSeen($seen) {
		if(is_int($seen) && !empty($seen)) {
			$this->seen = $seen;
		}
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
	 * Obtient l'id de l'chapter.
	 * @return int L'id de l'chapter
	 */
	public function getPostId() {
		return $this->post_id; 
    }
    
	/**
	 * Obtient le contenu du commentaire.
	 * @return string Le commentaire
	 */
	public function getComment() {
		return $this->comment; 
	}

	/**
	 * Obtient la date de publication du commentaire.
	 * @return DateTime Object La date de publication
	 */
	public function getCommentDate() {
		return $this->comment_date; 
	}

	/**
	 * Obtient l'auteur du commentaire.
	 * @return string L'auteur
	 */
	public function getAuthor() {
		return $this->author; 
    }
    
	/**
	 * Obtient la valeur de l'attribut 'Signaled'.
	 * @return int Le signalement
	 */
	public function getSignaled() {
		return $this->signaled; 
	}

	/**
	 * Obtient la valeur de l'attribut 'Signaled'.
	 * @return int Le signalement
	 */
	public function getSeen() {
		return $this->seen; 
	}
}