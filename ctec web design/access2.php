<?php

session_start();

if (!isset($_SESSION['access']) || $_SESSION['access'] != true)
{
  header('Location: login2.php');
  exit;
}

?>