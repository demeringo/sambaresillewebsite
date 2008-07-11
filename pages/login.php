<!--
<html>
<head>
<title>Login Page</title>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<script language="javascript" type="text/javascript" src="login.js"></script>
</head>
<body>
-->
<?php include("basicPageHeader.html"); ?>
<?php include("headersAndMenu.php"); ?>
<div id="content">	

<br/>
<br/>

<form id='log' method='post' action='templates/auth.php' onSubmit='javascript:submit_pass();'>
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
