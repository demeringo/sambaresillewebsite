<?php
include "config/auth-config.php";

session_start();

if(!isset($_SESSION['last_access']) || !isset($_SESSION['ipaddr']) || !isset($_SESSION['user']))
{
  header("Location: login.php");
  die();
}

if(time()-$_SESSION['last_access']>$session_timeout)
{
  unset($_SESSION['last_access']);
  unset($_SESSION['user']);
  unset($_SESSION['ipaddr']);
  header("Location: login.php");
  die();
}
if($_SERVER['REMOTE_ADDR']!=$_SESSION['ipaddr'])
{
  unset($_SESSION['last_access']);
  unset($_SESSION['user']);
  unset($_SESSION['ipaddr']);
  header("Location: login.php");
  die();
}
$_SESSION['last_access']=time();
?>
