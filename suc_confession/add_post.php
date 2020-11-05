<?php
session_start();
error_reporting(0);
include("include/config.php");

if(strlen($_SESSION['alogin'])==""){
	header("Location: index.php");
}

include("function/script_add_post.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/add_post.css">
</head>
<body>
	<?php
	include("include/top_bar.php");
	?>

	<form method="POST">
		<table>
			<tr>
				<td>Title: </td>
				<td><input type="text" name="title" required></td>
			</tr>

			<tr>
				<td>Message: </td>
				<td><textarea rows="12" name="message"></textarea></td>
			</tr>
				
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Submit"></td>
			</tr>

			<tr>
				<td colspan="2"><input type="button" name="" value="Cancel" onClick="location.href='index.php';"></td>
			</tr>
		</table>
	</form>

	<?php
	include("include/bottom_bar.php");
	?>
	<script src="js/main.js"></script>
</body>
</html>