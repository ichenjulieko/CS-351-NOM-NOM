<?php
require_once("../php/database_user.php");
	echo 'hi';

	$pass=mysqli_real_escape_string('$_POST[password]');
	$confirm=mysqli_real_escape_string('$_POST[confirmPassword]');

	if($pass==$confirm){
		mysqli_query($resourceID, "INSERT INTO user (username, password, email) 
		VALUES ('$_POST[name]','$_POST[password]','$_POST[email]')");

		echo '<script language="javascript">';
		echo 'Welcome to the NOM Palace';
		echo 'haiii';
		echo 'window.location.href = "mainpage.php"';
		echo '</script>';
	}
	else{
		echo '<script language="javascript">';
		echo 'Password and confirm password do not match';
		echo 'window.location.href = "SignUp.php"';
		echo '</script>';
	}
	


?>