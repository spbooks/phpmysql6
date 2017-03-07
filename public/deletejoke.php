<?php
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

	deleteJoke($pdo, $_POST['id']);

	header('location: jokes.php');
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';