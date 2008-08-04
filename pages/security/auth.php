<?php
function CheckUser($login,$md5)
{
  if($login=="user" && $md5=="ab4f63f9ac65152575886860dde480a1") // MD5 de azerty
    return true;
  return false;
}
?>
<?php
if(!isset($_POST['md5']))
{
  header("Location: ../login.php");
  die();
}
$md5=$_POST['md5'];

if(!isset($_POST['login']))
{
  header("Location: ../login.php");
  die();
}
$login=$_POST['login'];

if(!CheckUser($login,$md5))
{
  header("Location: ../login.php");
  die();
}

session_start();

$_SESSION['last_access']=time();
$_SESSION['ipaddr']=$_SERVER['REMOTE_ADDR'];
$_SESSION['user']=$login;

header("Location: ../manageAgenda.php");
?>
