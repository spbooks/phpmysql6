<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/controllers/JokeController.php';

	$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');

	$jokeController = new JokeController($jokesTable, $authorsTable);


	$action = $_GET['action'] ?? 'home';

	$page = $jokeController->$action();

	$title = $page['title'];
	$output = $page['output'];

}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';