<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb_sample;charset=utf8', 'ijdb_sample2', 'mypassword');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $output = 'Database connection established.';
}
catch (PDOException $e) {
  $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include '../templates/output.html.php';