<?php
exec('git status', $output);
$branchName = str_replace('On branch ', '', $output[0]);

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
	.files a {color: white; width: 30%; float: left; font-size: 2em}
	.files li {padding: 1em; border-top: 0.2em solid #fff; overflow: auto}
	.files li:first-child {border: 0}
	.files a:hover {color: #ddd}
	code {margin-top: 1em; background-color: #efefef; display: block; clear: both; padding: 0.2em;  overflow-x: auto}

	h2 {margin-top: 2em}
	</style>
	</head>
	<body>




	<h1>PHP Novice to Ninja sample code</h1>

	<p>Click on a file to view in your browser</p>

	<ul class="files">
	<?php

	foreach (new DirectoryIterator('.') as $file) {
		if ($file->isDot()) continue;
		if ($file->getFileName() == 'index.php') continue;

		$code = file_get_contents($file->getFileName());
		echo '<li><a href="' . $file->getFileName() . '">' . $file->getFileName() . '</a>';

		echo highlight_string($code, true);
		echo '</li>';
	}

	?>
	</ul>


	<h2>View a different sample</h2>

	<ul class="branches">


	</ul>
	</body>
</html>