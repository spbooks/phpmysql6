<?php
$roll = rand(1, 6);

echo '<p>You rolled a ' . $roll . '</p>';


if ($roll == 6 || $roll == 5) {
  echo '<p>You win!</p>';
}
else {
  echo '<p>Sorry, you didn\'t win, better luck next time!</p>';
}

echo '<p>Thanks for playing</p>';

?>