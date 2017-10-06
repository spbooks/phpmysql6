 
<?php
try {
	$pdo = new PDO('mysql:host=localhost;charset=utf8', 'homestead', 'secret');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
}
catch (PDOException $e) {
 	echo '<h3>Could not connect to database. Did you delete the `homestead` user or change it\'s password?</h3>';
 	echo '<p>' . $e . '</p>';
 	die;
}


try {
	//sample user might not exist so the query may throw an exception, that's fine, ignore it.
	try {
		//Drop the user, there's a chance the password has been changed
		$pdo->query('DROP USER \'ijdb_sample\'@\'localhost\'');
	}
	catch (PDOException $e) {}

	//Create the user for the sample code to use
	$pdo->query('CREATE USER \'ijdb_sample\'@\'localhost\' IDENTIFIED BY \'mypassword\'');

	//Drop the database, only one sample should be used at once.

	$pdo->query('DROP DATABASE IF EXISTS ijdb_sample');


	$pdo->query('CREATE DATABASE ijdb_sample');
	$pdo->query('GRANT ALL PRIVILEGES ON ijdb_sample.* To \'ijdb_sample\'@\'localhost\'');
	$pdo->query('FLUSH PRIVILEGES');
	$pdo->query('USE ijdb_sample');

	if (file_exists('../../database.sql')) {
		$pdo->exec(file_get_contents('../../database.sql'));
	}

}
catch (PDOException $e) {
	echo 'Could not create sample database/user';
	echo $e->getMessage();
}


exec('git status', $output);
$branchName = str_replace('On branch ', '', $output[0]);

if (isset($_GET['branch'])) {
	exec('git status', $status);
	$status = implode("\n", $status);
	if (strpos($status, 'nothing to commit') == false) {



		$parts = explode('_Modified', $branchName);
		$newBranchName = $parts[0] . '_Modified-' . date('Y-m-d-H.i.s');


		exec('git checkout -b ' . $newBranchName . ' 2>&1', $z);

		exec('git add -A 2>&1', $x);
		exec('git commit -m "user modified sample" 2>&1', $y);

		var_dump($z);
				var_dump($y);
						var_dump($x);
	}
	exec('git checkout "' . $_GET['branch'] . '"', $n);
	$branchName = $_GET['branch'];
}

if (!isset($branchName)) {
	exec('git status', $output);
	$branchName = str_replace('On branch ', '', $output[0]);
}


?><!doctype html>
<html>
	<head>
	<title><?= $branchName; ?> - PHP Nove to Ninja sample code</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<style>
	a {text-decoration: none}
	body {padding: 0; margin: 0 background-color: #f7f7f7; font-family: 'Roboto',arial,helvetica, sans-serif}
	h1 {padding: 1em; display: block; text-align: center}
	.files {display: block; background-color:#3a3a3a; padding: 10px; list-style-type: none; margin: 0}
	.files a, .files a:visited {color: white;  font-size: 2em}
	li {padding: 1em; border-top: 0.2em solid #fff; overflow: auto}
	li:first-child {border: 0}
	.files a:hover {color: #ddd}
	code {margin-top: 1em; background-color: #efefef; display: block; clear: both; padding: 0.5em;  overflow-x: auto}


	.branches {list-style-type: none; background-color: #ccc; padding: 0; font-size: 1.3em}
	.branches a, .branches a:visited {color: #000}
	h2 {margin-top: 2em}
	.current {font-weight: bold; background-color: #333;}
	.current a, .current a:visited {color: white}
	</style>
	</head>
	<body>




	<h1>PHP Novice to Ninja sample code</h1>

	<p>Click on a file to view in your browser</p>

	<ul class="files">
	<?php

	foreach (new DirectoryIterator('../') as $file) {
		if ($file->isDot()) continue;
		if ($file->getFileName() == 'samples') continue;

		$code = file_get_contents('../' . $file->getFileName());
		echo '<li><a href="/' . $file->getFileName() . '">' . $file->getFileName() . '</a>';

		echo highlight_string($code, true);
		echo '</li>';
	}

	?>
	</ul>


	<h2>View a different sample</h2>

	<ul class="branches">
	<?php


	exec('git branch -a', $branches);

	$branchList = [];

	foreach ($branches as $branch) {

		
		$branch = trim($branch, " \t*");
		$branch = str_replace('origin/', '', $branch);
		$branch = str_replace('remotes/', '', $branch);

		$branchList[$branch] = $branch;

	}

	foreach ($branchList as $branch) {
		$class =$branch == $branchName ? 'current' : '';

		if ($branch == 'master') continue;
		echo '<li class="' .$class . '"><a href="' . $_SERVER['PHP_SELF'] . '?branch=' . $branch . '">' .  $branch . '</a></li>';
	}


		
	?>
	</ul>
	</body>
</html> 
