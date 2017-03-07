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

	$keys = [];

	foreach ($fields as $key => $value) {
		$keys[] = '`' . $key . '`';
	}

	$query = 'INSERT INTO `joke` (' . implode(', ', $keys) . ') ';
	$query .= 'VALUES (';


	$fieldKeys = array_keys($fields);

	$query .= ':' . implode(', :', $fieldKeys) . ')';


	query($pdo, $query, $fields);
}

function updateJoke($pdo, $fields) {

	$query = ' UPDATE `joke` SET ';


	//Start off with an empty array
	$fieldArray = [];

	foreach ($fields as $key => $value) {
		//Add, for example, `id = :id` to the end of the array
		$fieldArray[] = '`' . $key . '` = :' . $key;
	}


	$query .= implode(', ', $fieldArray);


	$query .= ' WHERE `id` = :primaryKey';

	//Set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];
	query($pdo, $query, $fields);


  query($pdo, 'UPDATE `joke` SET `authorId` = :authorId, `joketext` = :joketext WHERE `id` = :id', $parameters);
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