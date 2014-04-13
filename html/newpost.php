<?php
require_once("../php/database_julie.php");
	// $top = $_POST['top'];
	// echo $_POST['top'];
	// echo 'hi';
	if($_POST['top']== "fiber"){
		mysqli_query($resourceID, "INSERT INTO healthnews (title, content, category) 
		VALUES ('$_POST[title]','$_POST[content]','Health News')");

	}
	if($_POST['top']== "facts"){

		mysqli_query($resourceID, "INSERT INTO healthnews (title, content, category) 
		VALUES ('$_POST[title]','$_POST[content]','Healthy Facts')");

	}
	if($_POST['top']== "adventures"){
		echo "adventures";
		mysqli_query($resourceID, "INSERT INTO healthnews (title, content, category) 
		VALUES ('$_POST[title]','$_POST[content]','Food-ventures')");
	}

	echo '<script language="javascript">';
	echo 'window.location.href = "blog.php"';
	echo '</script>';


?>