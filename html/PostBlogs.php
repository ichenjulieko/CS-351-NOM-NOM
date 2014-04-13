<!DOCTYPE html>
<html>
<head>
	<title>The NOM Palace</title>
	<?php require_once("../php/database_julie.php") ?>
	<link rel="stylesheet" type="text/css" href="../css/GeneralStyle.css" />
	<link rel="stylesheet" type="text/css" href="../css/MainPageStyle.css" />
	<script src="../jScript/jquery-1.11.0.js" /></script>
	<script type="text/javascript" src="../jScript/mainjq.js" /></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js" /></script>
	<script type="text/javascript" src="../jScript/BannerScript.js" /></script>
	<script type="text/javascript" src="../jScript/jquery.cycle.all.js" /></script>
</head>

<body>
	<!--	Load the banner 	-->
	<script/>loadBanner()</script>

	<form action="newpost.php" method="post">
		Choose a category for your new post: <br>
		<input type="radio" name="top" value="fiber">Health News<br>
		<input type="radio" name="top" value="facts">Healthy Facts<br>
		<input type="radio" name="top" value="adventures">Food-ventures<br>
		<!-- <select>
			<option name="top" value="news">Health News</option>
			<option name="top" value="facts">Healthy Facts</option>
			<option name="top" value="adventures">Food-ventures</option>
		</select>
		<br> -->
		Title: <input type="text" name="title" rows="2" cols="200"><br>
		<textarea name="content" rows="100" cols="100"></textarea>
		<input type="submit" value="Submit">
	</form>

	<!--	Load the footer 	-->
	<script/>loadFooter()</script>
</body>

</html>