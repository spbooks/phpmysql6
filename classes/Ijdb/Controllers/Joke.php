<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;

class Joke {
	private $authorsTable;
	private $jokesTable;

	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable, Authentication $authentication) {
		$this->jokesTable = $jokesTable;
		$this->authorsTable = $authorsTable;
		$this->authentication = $authentication;
	}

	public function list() {
		$jokes = $this->jokesTable->findAll();

		$title = 'Joke list';

		$totalJokes = $this->jokesTable->total();

		$author = $this->authentication->getUser();

		return ['template' => 'jokes.html.php', 
				'title' => $title, 
				'variables' => [
						'totalJokes' => $totalJokes,
						'jokes' => $jokes,
						'userId' => $author->id ?? null
					]
				];
	}

	public function home() {
		$title = 'Internet Joke Database';

		return ['template' => 'home.html.php', 'title' => $title];
	}

	public function delete() {

		$author = $this->authentication->getUser();

		$joke = $this->jokesTable->findById($_POST['id']);

		if ($joke->authorId != $author->id) {
			return;
		}
		

		$this->jokesTable->delete($_POST['id']);

		header('location: /joke/list'); 
	}

	public function saveEdit() {
		$author = $this->authentication->getUser();

		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();

		$author->addJoke($joke);

		header('location: /joke/list'); 
	}

	public function edit() {
		$author = $this->authentication->getUser();

		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
		}

		$title = 'Edit joke';

		return ['template' => 'editjoke.html.php',
				'title' => $title,
				'variables' => [
						'joke' => $joke ?? null,
						'userId' => $author->id ?? null
					]
				];
	}
	
}