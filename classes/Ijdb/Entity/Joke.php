<?php
namespace Ijdb\Entity;

class Joke {
	public $id;
	public $authorId;
	public $jokedate;
	public $joketext;
	private $authorsTable;

	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		return $this->authorsTable->findById($this->authorId);
	}
}