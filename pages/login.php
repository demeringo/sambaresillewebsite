<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3org/TR/xhtml/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes.html"); ?>
	<!-- Added to authenticate users -->
	<script language="javascript" type="text/javascript" src="security/login.js"></script>
</head>
<body>
<div id="page">
<?php include("headersAndMenu.php"); ?>
<div id="content">	

<br/>
<br/>

<form id='log' method='post' action='security/auth.php' onSubmit='javascript:submit_pass();'>
<input type='hidden' name='md5' />
<table align='center'>
<tr><td>Login</td><td><input name='login' /></td></tr>
<tr><td>Mot de passe</td><td><input type='password' name='passwd' /></td></tr>
<tr><td colspan='2' align='center'><input type='submit' value='Login !' /></td></tr>
</table>
</form>

</div>
<?php include("footer.html"); ?>
</body>
</html>
<!--</body>-->
