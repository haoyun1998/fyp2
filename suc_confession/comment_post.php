<?php
session_start();
error_reporting(0);

include("include/config.php");
include("function/timeago.php");

if(isset($_GET['post'])){
	$post = $_GET['post'];

	// if posts id is unavailable, then go to index.php(verify postsId)
	$sql = " SELECT * FROM posts WHERE postId=:post";
	$query = $dbh -> prepare($sql);
	$query -> bindParam(':post', $post, PDO::PARAM_STR);
	$query -> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		
	} else {
		header("Location: index.php");
	}

} else {
	//if dont have posts, then it will direct go index.php
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}

$userId = $_SESSION['id'];

if(strlen($_SESSION['alogin'])==""){
	header("Location: index.php");
}

if(isset($_POST['123'])){	
	$message = $_POST['message'];

	$sql="INSERT INTO comment(postsId, userId, message) values (:post, :userId, :message) ";
	$query= $dbh->prepare($sql);
	$query->bindParam(':post', $post, PDO::PARAM_STR);
	$query->bindParam(':userId', $userId, PDO::PARAM_STR);
	$query -> bindParam(':message', $message, PDO::PARAM_STR);
	$query->execute() or die();
	echo "<script>alert('Add Successful');</script>";
	echo "<script type='text/javascript'> document.location = 'comment_post.php?post=" . $post . "'; </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/comment_post.css">

</head>
<body>
	<?php
	include("include/top_bar.php");
	?>

<?php
$sql = "SELECT * FROM posts WHERE postId=:post";
$query = $dbh -> prepare($sql);
$query -> bindParam(':post', $post, PDO::PARAM_STR);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0){
	foreach($results as $result){
?>
	<div class="w3-card-4" style="width:50%;">
		    <header class="w3-container" style="background-color: rgb(66, 103, 178);">
		      <h1 class="w3-text-white"><?php echo htmlentities($result->title) ?></h1>
		    </header>

		    <div class="w3-container">
		      <p><?php echo htmlentities($result->message) ?></p>
		    </div>

		    <footer class="w3-container" style="background-color: rgb(66, 103, 178);">
		      <h5 class="w3-text-white"><i class="fa fa-thumbs-up"></i> <span style="float: right"><?php echo get_time_ago(htmlentities($result->postsTime)) ?></span></h5>
		    </footer>
		</div>
<?php
	}
}
?>

<?php
$sql = "SELECT * FROM comment WHERE postsId=:post";
$query = $dbh -> prepare($sql);
$query -> bindParam(':post', $post, PDO::PARAM_STR);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0){
	foreach($results as $result){
?>
	<div class="comment">
		<p style="border-bottom: 2px black solid">User<?php echo htmlentities($result->userId)?><span style="float: right;"><?php echo get_time_ago(htmlentities($result->commentTime)) ?></span></p>
		<p><?php echo htmlentities($result->message)?></p>
	</div>
<?php
	}
}
?>	

	<form method="post">
		<div class="comment">
			<p>Comment</p>
			<textarea rows="10" placeholder="Write something at here..." name="message"></textarea>
			<input type="submit" name="123" value="Post"> 
		</div>
	</form>

	<?php
	include("include/bottom_bar.php");
	?>

</body>
</html>