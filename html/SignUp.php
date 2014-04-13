<!--
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
-->


<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<?php require_once("../php/database_user.php") ?>
		<link rel="stylesheet" type="text/css" href="../css/GeneralStyle.css" />
		<link rel="stylesheet" type="text/css" href="../css/SignUpStyle.css" />
		<script type="text/javascript" src="../jScript/SignUpScript.js" /></script>
		<script type="text/javascript" src="../jScript/BannerScript.js" /></script>
	</head>
	<body>
		<!--	Load the banner 	-->
		<script/>loadBanner()</script>

		<br><br><br>

		<!--________________________________________________________________HTML_______________________________________________________________________-->

		<div id="join">
			<h2 style="color: #610B0B; text-align: center">JOIN US!</h2>
			<form id="form" action="adduser.php" method="post">
				<label>Userame: <input id="name" class="right" type="text" name="name"></label><br><br>
				<label>Password: <input id="pass" class="right" type="password" name="password"></label><br><br>
				<label>Confirm Password: <input id="confPass" class="right" type="password" name="confirmPassword"></label><br><br>
				<label>Email: <input id="email" class="right" type="text" name="email"></label><br><br><br>
				<input id = "submit" type="button" onclick="Validate()" value="Submit"/><br><br>
			</form>

			Already have an account? Click
			<a href="login.php">
			Here</a>
		</div>

		<div style="clear: both;"></div>
		<br><br><hr>

		<!--	Load the footer 	-->
		<script/>loadFooter()</script>
	</body>
</html>