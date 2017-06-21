<?php
namespace Ijdb\Controllers;
use \Ninja\DatabaseTable;

class Register {
	private $authorsTable;

	public function __construct(DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function registrationForm() {
		return ['template' => 'register.html.php', 
				'title' => 'Register an account'];
	}


	public function success() {
		return ['template' => 'registersuccess.html.php', 
			    'title' => 'Registration Successful'];
	}

	public function registerUser() {
		$author = $_POST['author'];

		//Assume the data is valid to begin with
		$valid = true;
		$errors = [];

		//But if any of the fields have been left blank, set $valid to false
		if (empty($author['name'])) {
			$valid = false;
			$errors[] = 'Name cannot be blank';
		}

		if (empty($author['email'])) {
			$valid = false;
			$errors[] = 'Email cannot be blank';
		}
		else if (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false) {
			$valid = false;
			$errors[] = 'Invalid email address';
		}

		if (empty($author['password'])) {
			$valid = false;
			$errors[] = 'Password cannot be blank';
		}

		//If $valid is still true, no fields were blank and the datacan be added
		if ($valid == true) {
			$this->authorsTable->save($author);

			$this->authorsTable->save($author);

			header('Location: /author/success');
		}
		else {
			//If the data is not valid, show the form again
			return ['template' => 'register.html.php', 
				    'title' => 'Register an account',
				    'variables' => [
				    	'errors' => $errors,
				    	'author' => $author
				    ]
				   ]; 
		}
	}
}