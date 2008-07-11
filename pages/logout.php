<?php
session_start();

unset($_SESSION['last_access']);
unset($_SESSION['user']);
unset($_SESSION['ipaddr']);
header("Location: login.php");
die();

?>
