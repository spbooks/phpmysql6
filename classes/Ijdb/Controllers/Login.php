<?php
namespace Ijdb\Controllers;

class Login {

	public function error() {
		return ['template' => 'loginerror.html.php', 'title' => 'You are not logged in'];
	}
}
