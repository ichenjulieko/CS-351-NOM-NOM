<?php
require_once("../php/database_julie.php");
echo "hi";
	if($_GET["op"]== "news"){
		$sql="INSERT INTO healthnews (category) 
		VALUES ('Health News')"
	}
	if($_GET["op"]== "facts"){
		$sql="INSERT INTO healthnews (category) 
		VALUES ('Healthy Facts')"
	}
	if($_GET["op"]== "adventures"){
		$sql="INSERT INTO healthnews (category) 
		VALUES ('Food-ventures')"
	}
	$sql="INSERT INTO healthnews (title, content)
	VALUES
	('$_GET[title]','$_GET[content]')";

	if (!mysqli_query($resourceID,$sql))
	  {
	  die('Error: ' . mysqli_error($resourceID));
	  }

	echo '<script language="javascript">';
	echo 'window.location.href = "blog.php"';
	echo '</script>';


?>