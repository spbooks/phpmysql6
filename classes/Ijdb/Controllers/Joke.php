<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Joke {
	private $authorsTable;
	private $jokesTable;

	public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable) {
		$this->jokesTable = $jokesTable;
		$this->authorsTable = $authorsTable;
	}

	public function list() {
		$result = $this->jokesTable->findAll();

		$jokes = [];
		foreach ($result as $joke) {
			$author = $this->authorsTable->findById($joke['authorId']);

			$jokes[] = [
				'id' => $joke['id'],
				'joketext' => $joke['joketext'],
				'jokedate' => $joke['jokedate'],
				'name' => $author['name'],
				'email' => $author['email']
			];

		}


		$title = '유머글 목';

		$totalJokes = $this->jokesTable->total();

		return ['template' => 'jokes.html.php', 
				'title' => $title, 
				'variables' => [
						'totalJokes' => $totalJokes,
						'jokes' => $jokes
					]
				];
	}

	public function home() {
		$title = '인터넷 유머 데이터베이스';

		return ['template' => 'home.html.php', 'title' => $title];
	}

	public function delete() {
		$this->jokesTable->delete($_POST['id']);

		header('location: /joke/list'); 
	}

	public function saveEdit() {
		$joke = $_POST['joke'];
		$joke['jokedate'] = new \DateTime();
		$joke['authorId'] = 1;

		$this->jokesTable->save($joke);
		
		header('location: /joke/list'); 
	}

	public function edit() {
		if (isset($_GET['id'])) {
			$joke = $this->jokesTable->findById($_GET['id']);
		}

		$title = '유머글 수정';

		return ['template' => 'editjoke.html.php',
				'title' => $title,
				'variables' => [
						'joke' => $joke ?? null
					]
				];
	}
	
}