<?php
namespace Ijdb\Entity;

class Author {

	const EDIT_JOKES = 1;
	const DELETE_JOKES = 2;
	const ADD_CATEGORIES = 4;
	const EDIT_CATEGORIES = 8;
	const REMOVE_CATEGORIES = 16;
	const EDIT_USER_ACCESS = 32;

	public $id;
	public $name;
	public $email;
	public $password;
	private $jokesTable;

	public function __construct(\Ninja\DatabaseTable $jokeTable) {
		$this->jokesTable = $jokeTable;
	}

	public function getJokes() {
		return $this->jokesTable->find('authorId', $this->id);
	}

	public function addJoke($joke) {
		$joke['authorId'] = $this->id;

		return $this->jokesTable->save($joke);
	}

	public function hasPermission($permission) {
		return $this->permissions & $permission;  
	}
}