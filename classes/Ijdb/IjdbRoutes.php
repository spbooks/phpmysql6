<?php
namespace Ijdb;

class IjdbRoutes {
	public function callAction($route) {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

		$jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
		$authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');

		if ($route === 'joke/list') {
			$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
			$page = $controller->list();
		}
		else if ($route === '') {
			$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
			$page = $controller->home();
		}
		else if ($route === 'joke/edit') {
			$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
			$page = $controller->edit();
		}
		else if ($route === 'joke/delete') {
			$controller = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
			$page = $controller->delete();
		}
		else if ($route === 'register') {
			$controller = new \Ijdb\Controllers\Register($authorsTable);
			$page = $controller->showForm();
		}

		return $page;
	}
}