<!--
	Eric Dong
	CS 351 Team Project
	Partner: Julie(Ichen) Ko
-->

<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("../php/database.php");
			require_once("../php/functionLibrary.php");
		?>
		<title>Vote</title>
		<link rel="stylesheet" type="text/css" href="../css/GeneralStyle.css" />
		<link rel="stylesheet" type="text/css" href="../css/VoteStyle.css" />
		<script type="text/javascript" src="../jScript/jquery-1.11.0.js" /></script>
		<script type="text/javascript" src="../jScript/VoteScript.js" /></script>
		<script type="text/javascript" src="../jScript/BannerScript.js" /></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js" /></script>

		<script>
			//	Pull all images from the database
			<?php
				$dbRecords = $sqlDatabase->query("SELECT * FROM " . $tableName) or die("Error reading table: " . mysql_error());

				while(($record = $dbRecords->fetch_array(MYSQLI_NUM))) {
					$data = array();	//	Array of all data of one image

					foreach($record as $key => $value)
						array_push($data, $value);

					//	Convert to javascript array
					$jsData = json_encode($data);
					echo "var jsData = " . $jsData . ";";
			?>
					readImages(jsData);
			<?php
				}
			?>
		</script>
	</head>
	<body onload="init(); gatherImageData()">
		<!-- Img for displaying pop ups -->
		<img src="" id="popup" alt="Broken" width="1" height="1" />
		<!-- Div for fading the background -->
		<div id="shade"></div>

		<!-- Upload button -->
		<button type="button" id="upload">Upload</button>
		<!-- Form for uploading image -->
		<div id="uploadDiv"><form id="uploadForm" action="../php/uploadFile.php" method="post" enctype="multipart/form-data">
				<label id="fileName" for="file">Filename:</label>
				<input id="browse" type="file" name="file" id="file"><br><br>
				<input id="submit" type="submit" name="submit" value="Submit">
				<iframe id="uploadTarget" name="uploadTarget" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
			</form>
			<button id="cancel" type="button">Cancel</button>
		</div>

		<!-- Vote/next buttons -->
		<button type="button" id="upVote" class="vote count" onclick="sendImageData(1)"></button>
		<button type="button" id="dismiss" class="vote" onclick="dismissPopup()"></button>
		<button type="button" id="downVote" class="vote count" onclick="sendImageData(0)"></button>

		<!-- Displays the pic's vote count -->
		<div id="voteCount">15</div>

		<!--	Load the banner 	-->
		<script>loadBanner()</script>
		<br><br>

		<!--________________________________________________________________Vote_______________________________________________________________________-->
		<hr>
		<h1 style="text-align: center">VOTE!</h1>
		<hr>

		<!--	Images	-->
		<div style="width: 100%">
			<table id="imgPanel" border="0">
				<tr>
					<td class="cell"> <div class="space"> <img id="one" class="image" src="" alt="one" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="two" class="image" src="" alt="two" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="three" class="image" src="" alt="three" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="four" class="image" src="" alt="four" /> </div> </td>
				</tr>

				<tr>
					<td class="cell"> <div class="space"> <img id="five" class="image" src="" alt="five" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="six" class="image" src="" alt="six" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="seven" class="image" src="" alt="seven" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="eight" class="image" src="" alt="eight" /> </div> </td>
				</tr>

				<tr>
					<td class="cell"> <div class="space"> <img id="nine" class="image" src="" alt="nine" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="ten" class="image" src="" alt="ten" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="eleven" class="image" src="" alt="eleven" /> </div> </td>
					<td class="cell"> <div class="space"> <img id="twelve" class="image" src="" alt="twelve" /> </div> </td>
				</tr>
			</table>

			<!--	Next arrow 	-->
			<img src="../ref/NextArrow.png" id="next" alt="next" />
		</div>

		<!--_______________________________________________________________FOOTER______________________________________________________________________-->

		<div style="clear: both;"></div>
		<br><br><hr>

		<!--	Load the footer 	-->
		<script/>loadFooter()</script>

		<!--___________________________________________________________JAVASCRIPT/PHP__________________________________________________________________-->

		<script>
			//	Sends the necessary data for voting
			function sendImageData(vote) {
				var currImg = document.getElementById("popup");
				var imgSrc = currImg.src;

				//	Cut off url only to file name and extension
				var i;
				for(i = imgSrc.length - 1; i >= 0; i--) {
					if(imgSrc[i] == '/')
						break;
				}

				imgSrc = imgSrc.substring(i+1);

				//	Send to server side
				window.location.href = "Vote.php?src=" + imgSrc + "&vote=" + vote;
			}

			//	Gathers vote data and records it
			function gatherImageData() {
				<?php
					if(isset($_GET["src"]) && isset($_GET["vote"])) {
						$imgSrc = $_GET["src"];

						//	Retrieve record containing the image
						$records = $sqlDatabase->query("SELECT * FROM " . $tableName . " WHERE FilePath = '../UserImages/" . $imgSrc . "'")
							or die("Error reading table: " . mysql_error());

						while(($record = $records->fetch_array(MYSQLI_NUM))) {
							$points = $record[4];

							//	Upvote/Downvote
							if($_GET["vote"] == 1)
								$points++;
							else if($_GET["vote"] == 0)
								$points--;

							$fieldsToSet = array();
							$fieldValues = array();

							$fieldsToSet[0] = "Points";
							$fieldValues[0] = "$points";

							//	Send modify query to database
							if(modify($sqlDatabase, $tableName, $fieldsToSet, $fieldValues, $record[0]) == 0) {
								echo 'alert("Error: Unable to vote.");';
								echo 'window.location.href = "Vote.php";';
							}
							else
								echo 'alert("Vote submitted!");';
						}

						//	Redirect back to page
						echo 'window.location.href = "Vote.php";';
					}
				?>
			}

			function getImageCount() {
				var currImg = document.getElementById("popup");
				var imgSrc = currImg.src;

				//	Cut off url only to file name and extension
				var i;
				for(i = imgSrc.length - 1; i >= 0; i--) {
					if(imgSrc[i] == '/')
						break;
				}

				imgSrc = imgSrc.substring(i+1);

				//	Send to server side
				$.ajax({
					url: "../php/getVoteCount.php",
					type: "post",
					data: { getcount: "1", src: imgSrc },
					success: function(data) {
						if(data < 0)
							$('#voteCount').css("color", "red");
						else if(data == 0)
							$('#voteCount').css("color", "grey");
						else
							$('#voteCount').css("color", "green");

						document.getElementById("voteCount").innerHTML = data;
					}
				});
			}

			
		</script>

		<?php $sqlDatabase->close(); ?>
	</body>
</html>