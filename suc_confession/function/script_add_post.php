<?php

if(isset($_POST['submit'])){
	$userId = $_SESSION['id'];
	$title = $_POST['title'];
	$message = $_POST['message'];

	$sql = "INSERT INTO posts(userId, title, message) values (:userId, :title, :message)";
	$query = $dbh -> prepare($sql);
	$query -> bindParam(":userId", $userId, PDO::PARAM_STR);
	$query -> bindParam(":title", $title, PDO::PARAM_STR);
	$query -> bindParam(":message", $message, PDO::PARAM_STR);
	$query -> execute() or die();
	echo "<script>alert('Successful')</script>";
	echo "<script type='text/javascript'>document.location='index.php'</script>";
}

?>