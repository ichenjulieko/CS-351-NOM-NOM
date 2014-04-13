<!--
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
-->

<?php
	require_once("database.php");
	require_once("functionLibrary.php");

	if(isset($_FILES["file"])) {
		$allowedExt = array("png", "jpg", "jpeg", "gif");
		$split = explode(".", $_FILES["file"]["name"]);
		$fileExt = end($split);

		//	Check for correct file type
		if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 10000000)
			&& in_array($fileExt, $allowedExt))
		{

			if($_FILES["file"]["error"] > 0) {
				//	Return error message
				print json_encode(array(
					"success"		=>		false,
					"failure"		=>		true,
					"message"		=>		$_FILES["file"]["error"]
				));
			}
			else {
				//	Save file to database
				if(file_exists("../UserImages/" . $_FILES["file"]["name"])) {
					//	Return error message
					print json_encode(array(
							"success"		=>		false,
							"failure"		=>		true,
							"message"		=>		"An image with this name has already been uploaded.\nPlease rename your file."
					));
				}
				else {
					$fileName = $split[0];

					//	Save to UserImages folder
					move_uploaded_file($_FILES["file"]["tmp_name"], "../UserImages/" . $_FILES["file"]["name"]);

					//	Insert data to database table
					$id = getNextID($sqlDatabase, $tableName);
					if(!insert($sqlDatabase, $tableName, $id, $fileName, "../UserImages/" . $_FILES["file"]["name"], "Anonymous", 0)) {
						//	Something went wrong
						print json_encode(array(
							"success"		=>		false,
							"failure"		=>		true,
							"message"		=>		"Unknown Error: Please try again later."
						));
					}
					else {
						//	Return success message
						print json_encode(array(
							"success"		=>		true,
							"src"			=>		"../UserImages/" . $_FILES["file"]["name"]
						));
					}
				}
			}
		}
		else {
			//	Return error message
			print json_encode(array(
					"success"		=>		false,
					"failure"		=>		true,
					"message"		=>		"Invalid format or size."
			));
		}
	}
?>