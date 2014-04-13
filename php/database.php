<!--
	Eric Dong & Julie Ko
	CS 351 Team Project
-->

<?php

	$dbName = "NOM_Palace";
	$tableName = "Food_Images";
	$username = "root";
	$password = "root";

	//	Connect to server
	$sqlDatabase = new mysqli("localhost", $username, $password, $dbName);

	if($sqlDatabase->connect_errno) {
		printf("Connection failed: %s\n", mysqli_connect_error());
		exit();
	}
?>