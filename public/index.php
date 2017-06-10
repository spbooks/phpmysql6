<?php
function loadTemplate($templateFileName, $variables = []) {
	extract($variables);

	ob_start();
	include  __DIR__ . '/../templates/' . $templateFileName;

	return ob_get_clean();
}

try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/controllers/DatabaseTable.php';

	$jokesTable = new DatabaseTable($pdo, 'joke', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');


	$action = $_GET['action'] ?? 'home';

	$controllerName = $_GET['controller'] ?? 'joke';

	if ($action == strtolower($action) && $controllerName == strtolower($controllerName)) {

		$className = ucfirst($controllerName) . 'Controller';

		include __DIR__ . '/../controllers/' . $className . '.php';

		if ($controllerName === 'joke') {
			$arguments = [$jokesTable, $authorsTable];
		}
		else if ($controllerName === 'register') {
			$arguments = [$authorsTable];
		}
		
		$controller = new $className(...$arguments);
		$page = $controller->$action();
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