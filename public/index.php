<?php
function loadTemplate($templateFileName, $variables = []) {
	extract($variables);

	ob_start();
	include  __DIR__ . '/../templates/' . $templateFileName;

	return ob_get_clean();
}

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');


	$action = $_GET['action'] ?? 'home';

	$controllerName = $_GET['controller'] ?? 'joke';

	if ($action == strtolower($action) && $controllerName == strtolower($controllerName)) {

			$route = $_GET['route'] ?? 'joke/home'; //if no route variable is set, use 'joke/home'

			if ($route === 'joke/list') {
				include __DIR__ . '/../classes/controllers/JokeController.php';
				$controller = new JokeController($jokesTable, $authorsTable);
				$page = $controller->list();
			}
			else if ($route === 'joke/home') {
				include __DIR__ . '/../classes/controllers/JokeController.php';
				$controller = new JokeController($jokesTable, $authorsTable);
				$page = $controller->home();
			}
			else if ($route === 'register') {
				include __DIR__ . '/../classes/controllers/RegisterController.php';
				$controller = new RegisterController($authorsTable);
				$page = $controller->showForm();
			}
	}
	else {
		http_response_code(301);
		header('location: index.php?controller=' . strtolower($controllerName) . '&action=' . strtolower($action));
	}


	$title = $page['title'];

	if (isset($page['variables'])) {
		$output = loadTemplate($page['template'], $page['variables']);
	}
	else {
		$output = loadTemplate($page['template']);
	}
	
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';