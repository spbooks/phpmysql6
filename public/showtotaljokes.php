<?php
//Include the file which creates the $pdo variable and connects to the database
include_once __DIR__ . '/../includes/DatabaseConnection.php';

//Include the file which provides the `totalJokes` function
include_once __DIR__ . '/../includes/DatabaseFunctions.php';

//Call the function
echo totalJokes($pdo);