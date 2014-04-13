<!--
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
-->

<?php
	//	RETURNS THE VOTE COUNT OF A FOOD IMAGE SO IT CAN BE DISPLAYED

	require_once("database.php");
	require_once("functionLibrary.php");

	if(isset($_POST["getcount"])) {
		$imgSrc = "../UserImages/" . $_POST["src"];

		$dbRecords = $sqlDatabase->query("SELECT * FROM " . $tableName . " WHERE FilePath = '$imgSrc'");

		while(($record = $dbRecords->fetch_array(MYSQLI_ASSOC))) {
			print $record["Points"];
		}
	}
?>