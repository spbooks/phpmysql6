<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb_sample', 'ijdb_sample', 'mypassword');
  $output = 'Database connection established.';
}
catch (PDOException $e) {
  $output = 'Unable to connect to the database server: ' . $e;
}

include  __DIR__ . '/../templates/output.html.php';