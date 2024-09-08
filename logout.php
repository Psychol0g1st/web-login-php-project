<?php
require 'session.php';

$_SESSION['error'] = "";
$_SESSION['logged_in'] = false;
$_SESSION['username'] = "";
header("Location: index.php");
exit();