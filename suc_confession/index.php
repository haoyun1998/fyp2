<?php
session_start();
error_reporting(0);
include("include/config.php");

include("function/script_user_login.php");
include("function/timeago.php");

if(!isset($_GET['page'])){
	$page = 1;
} else {
	$page = $_GET['page'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<?php
	include("include/top_bar.php");
	?>

<?php
//pagination(check data quantity) & calculate the pages 
$sql = "SELECT * FROM posts WHERE status = 1";
$query = $dbh -> prepare($sql);
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
// paginatio(formula)
$number_of_results = $query->rowCount();
$results_per_page = 5;
$number_of_page = ceil($number_of_results / $results_per_page);
$this_page_first_result = ($page - 1) * $results_per_page;
//display the output of current page
$sql = "SELECT * FROM posts WHERE status = 1 LIMIT :this_page_first_result, :results_per_page";
$query = $dbh -> prepare($sql);
$query -> bindParam(':this_page_first_result', $this_page_first_result, PDO::PARAM_INT);
$query -> bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
$query -> execute() or die();
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
		      <h5 class="w3-text-white"><i class="fa fa-thumbs-up"></i> <a href="comment_post.php?post=<?php echo htmlentities($result->postId) ?>" onclick="<?php if (strlen($_SESSION['alogin']) == 0) {?>onlylogin()<?php }?>">Comment</a><span style="float: right"><?php echo get_time_ago(htmlentities($result->postsTime)) ?></span></h5>
		    </footer>
		</div>
<?php
	}
}
?>
	<!-- pagination -->
	<div class="pagination">
	<?php 
	if (($page == 1 && $page == $number_of_page) || ($page == 1 && $number_of_page == 0)) {
		echo '<a class="active" href="index.php?page=' . $page . '">' . $page . '</a>';
	} else if ($page == 1) {
		echo '<a class="active" href="index.php?page=' . $page . '">' . $page . '</a>';
		echo '<a href="index.php?page=' . ($page+1) . '">' . ($page+1) . '</a>';
		echo '<a href="index.php?page=' . $number_of_page . '">&raquo;</a>';
	} else if ($page == $number_of_page) {
		echo '<a href="index.php?page=1">&laquo;</a>';
		echo '<a href="index.php?page=' . ($page-1) . '">' . ($page-1) . '</a>';
		echo '<a class="active" href="index.php?page=' . $page . '">' . $page . '</a>';
	} else {
		echo '<a href="index.php?page=1">&laquo;</a>';
		echo '<a href="index.php?page=' . ($page-1) . '">' . ($page-1) . '</a>';
		echo '<a class="active" href="index.php?page=' . $page . '">' . $page . '</a>';
		echo '<a href="index.php?page=' . ($page+1) . '">' . ($page+1) . '</a>';
		echo '<a href="index.php?page=' . $number_of_page . '">&raquo;</a>';
	}
	?>
	</div>
	<!-- pagination -->

	<?php
	include("include/bottom_bar.php");
	?>
	
	<script src="js/main.js"></script>
</body>
</html>