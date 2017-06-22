<?php
session_start();

if (!isset($_SESSION['visits']))
{
  $_SESSION['visits'] = 0;
}
$_SESSION['visits'] = $_SESSION['visits'] + 1;



if ($_SESSION['visits'] > 1)
{
  echo 'This is visit number ' . $_SESSION['visits'];
}
else
{
  // First visit
  echo 'Welcome to my website! Click here for a tour!';
}