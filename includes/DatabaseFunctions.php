<?php

function totalJokes($database) {
	$query = $database->prepare('SELECT COUNT(*) FROM joke');
	$query->execute();

	$row = $query->fetch();

	return $row[0];
}

?>