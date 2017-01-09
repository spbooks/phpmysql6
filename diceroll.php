<?php

$roll = rand(1, 6);

echo '<p>You rolled a ' . $roll . '</p>';


if ($roll == 6) {
  echo '<p>You win!</p>';
}

echo '<p>Thanks for playing</p>';

?>