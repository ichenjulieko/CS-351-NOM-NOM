<!DOCTYPE html>
<html>
<head>
	<title>The NOM Palace</title>
	<?php require_once("../php/database_julie.php") ?>
	<link rel="stylesheet" type="text/css" href="../css/GeneralStyle.css" />
	<link rel="stylesheet" type="text/css" href="../css/MainPageStyle.css" />
	<link rel="stylesheet" type="text/css" href="../css/blog.css" />
	<script src="../jScript/jquery-1.11.0.js" /></script>
	<script type="text/javascript" src="../jScript/mainjq.js" /></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js" /></script>
	<script type="text/javascript" src="../jScript/BannerScript.js" /></script>
	<script type="text/javascript" src="../jScript/jquery.cycle.all.js" /></script>
</head>

<body>
	<!--	Load the banner 	-->
	<script/>loadBanner()</script>
	<div id="categories">
		<p id="cat">Categories</p>
		<a href="">Health News</a><br>
		<a href="">Healthy Facts</a><br>
		<a href="">Food-ventures</a><br>
	</div>
<?php
// $sql="DELETE FROM healthnews WHERE category='' OR title=''";
// mysqli_query($resourceID, $sql);
 ?>
 <p id="new">Have new ideas to share? Click 
 	<a href="PostBlogs.php">Here</a> to post it to the blog!</p>
	<div id="allposts">	 	 
	<?php 
	while($row = mysqli_fetch_array($dbRecords)){ ?>
		<br><br><div id="posts">
		Category: <a href=""><?php echo $row[2]; ?></a><br>
		<?php 
			?>
			<div id="title"> 
			<?php echo $row[0]; ?></div> <br>
			<?php echo $row[1]; ?></div> <br>


	<?php } 
	?>
	</div>

	<!--	Load the footer 	-->
	<script/>loadFooter()</script>
</body>

</html>