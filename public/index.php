<?php
try {
	include __DIR__ . '/../includes/autoload.php';
	include __DIR__ . '/../classes/IjdbRoutes.php';
	
	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

	$entryPoint = new EntryPoint($route, new IjdbRoutes());
	$entryPoint->run();
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();

	include  __DIR__ . '/../templates/layout.html.php';
}
