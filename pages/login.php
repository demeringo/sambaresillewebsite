<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3org/TR/xhtml/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include("includes-black.html"); ?>
	<!-- Added to authenticate users -->
	<script language="javascript" type="text/javascript" src="security/login.js"></script>
</head>
<body>
<div id="page">
<?php include("headersAndMenu.php"); ?>
<div id="content">	
<br/>
<br/>
<br/>
<br/>
<br/>
<form id='log' method='post' action='security/auth.php' onSubmit='javascript:submit_pass();'>
<input type='hidden' name='md5' />
<table align='center'>
<tr><td>Login</td></td><td><td><input name='login' style='font-size:20px'/><br/><br/></td></tr>
<tr><td>Mot de passe</td><td></td><td><input type='password' name='passwd' style='font-size:20px'/><br/><br/></td></tr>
<tr><td colspan='3' align='center'><input type='submit' value='Login !' /></td></tr>
</table>
</form>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</div>
<?php include("footer.html"); ?>
</body>
</html>
<!--</body>-->
