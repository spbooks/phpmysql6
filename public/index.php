<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb_sample;charset=utf8', 'ijdb_sample', 'mypassword');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $sql = 'SELECT joketext FROM joke';
  $result = $pdo->query($sql);

  while ($row = $result->fetch()) {
     $jokes[] = $row['joketext'];
  }

}
catch (PDOException $e) {
  $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include '../templates/jokes.html.php';