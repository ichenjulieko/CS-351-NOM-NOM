<html>
	<head>
		<?php
			require_once("database.php");
			require_once("functionLibrary.php");
		?>
	</head>

	<body>
		<h1>Food!</h1>
		<table id="myTable" border="1" cellpadding="5">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>FilePath</th>
				<th>User</th>
				<th>Points</th>
			</tr>

			<?php $dbRecords = $sqlDatabase->query("SELECT * FROM " . $tableName) or die("Error reading table: " . mysql_error());
			//	Create a new row for each record of data
			while(($record = $dbRecords->fetch_array(MYSQLI_NUM))) { ?>

			<tr>
				<td><?php echo $record[0]; ?></td>
				<td><?php echo $record[1]; ?></td>
				<td><?php echo $record[2]; ?></td>
				<td><?php echo $record[3]; ?></td>
				<td><?php echo $record[4]; ?></td>
			</tr>	

			<?php } ?>
		</table>
		<br><br><br>

		<form id="form" action="main.php" method="get">
			<input type="radio" name="op" value="delete">Delete By ID<br>
			<input type="radio" name="op" value="insert">Insert New Image<br>

			ID:	   <input type="text" name="ID"><br>
			Name: <input type="text" name="Name"><br>
			FilePath: <input type="text" name="FilePath"><br>
			User: <input type="text" name="User"><br>
			Points: <input type="text" name="Points"><br>
			<input type="submit" value="Submit">
		</form>

		<!-- LISTENER FOR CLIENT REQUESTS -->
		<?php
			if($_GET["op"] == "delete") {
				//	Error checking
				if(!is_numeric($_GET["id"])) {
					echo '<script language="javascript">';
					echo 'alert("Error: ID must be a number.");';
					echo 'window.location.href = "main.php"';
					echo '</script>';
				}
				else {
					if(delete($sqlDatabase, $tableName, $_GET["id"]) == 0) {
						echo '<script language="javascript">';
						echo 'alert("Error: ID not found.")';
						echo '</script>';
					}
					else {
						echo '<script language="javascript">';
						echo 'alert("Movie deleted successfully!");';
						echo 'window.location.href = "main.php"';
						echo '</script>';
					}
				}
			}
			else if($_GET["op"] == "insert") {
				$id = $_GET["ID"];
				$name = $_GET["Name"];
				$filePath = $_GET["FilePath"];
				$user = $_GET["User"];
				$points = $_GET["Points"];

				if(insert($sqlDatabase, $tableName, $id, $name, $filePath, $user, $points) == -1) {
					echo '<script language="javascript">';
					echo 'alert("Error: That ID is already taken.")';
					echo '</script>';
				}
				else {
					echo '<script language="javascript">';
					echo 'alert("Movie inserted successfully!");';
					echo 'window.location.href = "main.php"';
					echo '</script>';
				}
			}
		?>

		<script type="text/javascript">
			//	Deals with all insert, modify, and delete operations
			function operation(op) {

				/*		THIS CODE BLOCK MIGHT BE USERFUL FOR THE PROJECT	*/
				//	Delete
				if(op == 0) {
					var toDelete = prompt("Enter the movie's ID:", "");
					while(isNaN(toDelete) || toDelete == "")
							toDelete = prompt("Error: ID must be a number. Try again:", "");

					if(toDelete == null)
						window.location.href = "main.php";
					else
						window.location.href = "main.php?op=deleteMovie&id=" + toDelete;
				}

				//	Insert
				else if(op == 1) {
					var id = prompt("Enter the movie's ID:", "");
					while(isNaN(id) || id == "")
						id = prompt("Error: ID must be a number. Try again:", "");
					if(id == null)
						window.location.href = "main.php";

					var title = prompt("Enter the movie's title:", "");
					while(title == "")
						title = prompt("Error: You must give your movie a name:", "");
					if(title == null)
						window.location.href = "main.php";

					var price = prompt("Enter the movie's price:", "");
					while(isNaN(price) || price == "")
						price = prompt("Error: Price must be a number. Try again:", "");
					if(price == null)
						window.location.href = "main.php";

					window.location.href = "main.php?op=insertMovie&id=" + id + "&title=" + title + "&price=" + price;
				}

				//	Modify
				else if(op == 2) {
					var id = prompt("Enter the movie's ID:", "");
					while(isNaN(id) || id == "")
						id = prompt("Error: ID must be a number. Try again:", "");
					if(id == null)
						window.location.href = "main.php";

					var title = prompt("Enter the new title, or leave it blank if no change:", "");
					if(title == null)
						window.location.href = "main.php";

					var price = prompt("Enter the new price, or leave it blank if no change:", "");
					if(price == null)
						window.location.href = "main.php";

					if(title == "" && price == "") {
						alert("You've modified nothing...");
						window.location.href = "main.php";
					}
					else
						window.location.href = "main.php?op=modifyMovie&id=" + id + "&title=" + title + "&price=" + price;
				}
			}
		</script>

		<?php $sqlDatabase->close(); ?>
	</body>
</html>