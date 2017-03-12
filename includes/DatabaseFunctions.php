<?php

function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}


function totalJokes($pdo) {
  $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
  $row = $query->fetch();
  return $row[0];
}



function getJoke($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);

	return $query->fetch();
}


function insertJoke($pdo, $fields) {
	$query = 'INSERT INTO `joke` (';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');

	$query .= ') VALUES (';


	foreach ($fields as $key => $value) {
		$query .= ':' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ')';

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}


function updateJoke($pdo, $fields) {

	$query = ' UPDATE `joke` SET ';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ' WHERE `id` = :primaryKey';

	//Set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}



function deleteJoke($pdo, $id) {
  $parameters = [':id' => $id];

  query($pdo, 'DELETE FROM `joke` WHERE `id` = :id', $parameters);
}


function allJokes($pdo) {
  $jokes =  query($pdo, 'SELECT `joke`.`id`, `joketext`, `name`, `email`
          				 FROM `joke` INNER JOIN `author`
            			 ON `authorid` = `author`.`id`');

  return $jokes->fetchAll();
}


function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}

	return $fields;
}