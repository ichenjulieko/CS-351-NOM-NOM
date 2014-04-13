<!--
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
-->

<?php
//	Display all data
function displayRecords($dbRecords) {
	while(($record = $dbRecords->fetch_array(MYSQLI_NUM))) {
		foreach($record as $cell)
			echo $cell . " | ";

		echo "<br>";
	}
}

//	Returns the next available ID in a table
//	NOTE: assumes the IDs start at 1
function getNextID($sqlDatabase, $tableName) {
	$dbRecords = $sqlDatabase->query("SELECT * FROM " . $tableName) or die("Error reading table: " . mysql_error());

	$i = 1;
	while(($record = $dbRecords->fetch_array(MYSQLI_NUM))) { $i++; }

	return $i;
}

//	Insert data into table
function insert($sqlDatabase, $tableName, $id, $name, $filePath, $user, $points) {
	$sqlDatabase->query("INSERT INTO " . $tableName . " VALUES ('$id', '$name', '$filePath', '$user', '$points')");

	return $sqlDatabase->affected_rows;
}

//	Delete element with ID from table
function delete($sqlDatabase, $tableName, $ID) {
	$sqlDatabase->query("DELETE FROM ". $tableName . " WHERE ID='$ID'");

	return $sqlDatabase->affected_rows;
}

//	Modify an element with ID in table by setting $fieldsToSet with corresponding $fieldValues
function modify($dbRecords, $table, $fieldsToSet, $fieldValues, $ID) {
	$query = "UPDATE $table SET ";

	//	Build the query
	for($i = 0; $i < count($fieldsToSet); $i++) {
		$query .= $fieldsToSet[$i] . "=" . "'" . $fieldValues[$i] . "'";

		if($i != count($fieldsToSet) - 1)
			$query .= ", ";
		else
			$query .= " ";
	}
	$query .= "WHERE ID='$ID'";

	$dbRecords->query($query);

	return $dbRecords->affected_rows;
}

?>