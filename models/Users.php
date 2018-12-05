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

	public function hydrate($data)
	{
		foreach($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists([$this, $method])) {
				$this->$method($value);
			}
		}
    }
}