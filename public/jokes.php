<?php

try {
  include '../includes/DatabaseConnection.php';

  $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
          FROM `joke` INNER JOIN `author`
            ON `authorid` = `author`.`id`';

  $jokes = $pdo->query($sql);


  $title = 'Joke list';

  ob_start();

  include  __DIR__ . '/../templates/jokes.html.php';

  $output = ob_get_clean();

}
catch (PDOException $e) {
  $title = 'An error has occurred';

  $output = 'Database error: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';