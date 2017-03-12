<?php

function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}


function total($pdo, $table) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
	$row = $query->fetch();
	return $row[0];
}




function findById($pdo, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';

	$parameters = [
		'value' => $value
	];

	$query = query($pdo, $query, $parameters);

	return $query->fetch();
}


function insert($pdo, $table, $fields) {

	$keys = [];

	foreach ($fields as $key => $value) {
		$keys[] = '`' . $key . '`';
	}

	$query = 'INSERT INTO `' . $table .'` (' . implode(', ', $keys) . ') ';
	$query .= 'VALUES (';


	$fieldKeys = array_keys($fields);

	$query .= ':' . implode(', :', $fieldKeys) . ')';

	$fields = processDates($fields);
	
	query($pdo, $query, $fields);
}


function update($pdo, $table, $primaryKey, $fields) {

	$query = ' UPDATE `' . $table .'` SET ';


	//Start off with an empty array
	$fieldArray = [];

	foreach ($fields as $key => $value) {
		//Add, for example, `id = :id` to the end of the array
		$fieldArray[] = '`' . $key . '` = :' . $key;
	}


	$query .= implode(', ', $fieldArray);


	$query .= ' WHERE `' . $primaryKey . '` = :primaryKey';

	//Set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];

	$fields = processDates($fields);

	query($pdo, $query, $fields);
}



function delete($pdo, $table, $primaryKey, $id ) {
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = :id', $parameters);
}


function findAll($pdo, $table) {
	$result = query($pdo, 'SELECT * FROM `' . $table . '`');

	return $result->fetchAll();
}

function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}

	return $fields;
}


function save($pdo, $table, $primaryKey, $record) {
	try {
		if ($record[$primaryKey] == '') {
			$record[$primaryKey] = null;
		}
		insert($pdo, $table, $record);
	}
	catch (PDOException $e) {
		update($pdo, $table, $primaryKey, $record);
	}
}