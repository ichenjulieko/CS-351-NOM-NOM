<!DOCTYPE html>
<html>
<head>
	<title>
		Reset Password?
	</title>
	<?php require_once("../php/database_user.php") ?>
	<link type="text/css" rel="stylesheet" href="../css/GeneralStyle.css"/>
	<link rel="stylesheet" type="text/css" href="../css/SignUpStyle.css" />
	<script type="text/javascript" src="../jScript/BannerScript.js" /></script>
	<script type="text/javascript" src="../jScript/SignUpScript.js" /></script>
</head>
<body>
	<!--	Load the banner 	-->
		<script/>loadBanner()</script>

		<br><br><br><br><br>
	<div id="join" class="center">
			<h2 style="color: #610B0B; text-align: center">Enter your email to reset password</h2>
			<form id="login" class="center">
				<label>Email: <input class="center" id="email" type="text" name="email"></label><br><br><br>
				<input class="center" type="button" onclick="Validate()" value="Submit"/><br><br>
			</form>
		</div>

		<div style="clear: both;"></div>
		<br><br><hr>
		<!--	Load the footer 	-->
		<script/>loadFooter()</script>

</body>