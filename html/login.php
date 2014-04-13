<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<?php require_once("../php/database_user.php") ?>
		<link type="text/css" rel="stylesheet" href="../css/GeneralStyle.css"/>
		<link rel="stylesheet" type="text/css" href="../css/SignUpStyle.css" />
		<script type="text/javascript" src="../jScript/LoginScript.js" /></script>
		<script type="text/javascript" src="../jScript/BannerScript.js" /></script>
	</head>

	<body>
		<!--	Load the banner 	-->
		<script/>loadBanner()</script>

		<br><br>
		<div id="join" class="center">
			<h2 style="color: #610B0B; text-align: center"><strong>Login to your account!</strong></h2></br><br><br>
			<form>
			<label>Username: <input type='text' id='username' /></label>
			<br><br><br>
			<label>Password: <input type='text' id='pass'></label>
			<br><br><br>
			<input type='button' onclick='validateform()' value='Submit' />
			</form>
			<a href="ForgetPassword.php">
			<br>Forget your password?</br></a>
			Don't have an account yet? Click
			<a href="SignUp.php">
			Here</a> to sign up!
		</div>

		<div style="clear: both;"></div>
		<br><br><hr>

		<!--	Load the footer 	-->
		<script/>loadFooter()</script>
	</body>
</html>