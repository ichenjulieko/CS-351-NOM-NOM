<?php
ini_set('display_errors','On');
$resourceID = mysqli_connect("localhost", "root", "root", "users") 
or die(mysql_error());

if(mysqli_connect_errno()){
	printf("Could not connect: %s\n", mysqli_connect_error());
	exit();
}
$dbRecords = mysqli_query($resourceID, "SELECT*FROM user")
	or die("Problem reading table: ".mysql_error());
?>