<?php

$name = $_GET['name'];
echo 'Welcome to our website, ' .  htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '!';

?>