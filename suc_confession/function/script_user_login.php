<?php
// if (isset($_SESSION['alogin']) && $_SESSION['alogin'] != '') {
// 	$_SESSION['alogin'] = '';
// }

if (isset($_POST['Lsubmit'])) {
	$username = $_POST['Lusername'];
	$password = $_POST['Lpassword'];

	$sql = "SELECT username, password, id FROM user WHERE username=:username AND password=:password";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':username', $username, PDO::PARAM_STR);
	$query -> bindParam(':password', $password, PDO::PARAM_STR);
	$query -> execute() or die();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	if ($query->rowcount() > 0) {
		$_SESSION['alogin']=$_POST['Lusername'];
		foreach ($results as $result) {
			if(!empty($_POST['remember'])){
				setcookie("username", $_POST['Lusername'], time()+ (10 * 365 * 24 * 60 * 60));
				setcookie("password", $_POST['Lpassword'], time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				setcookie("username", "");
				setcookie("password", "");
			}
			$_SESSION['id'] = htmlentities($result->id);
		}
		echo "<script>alert('Welcome back');</script>";
		echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	} else {
		echo "<script>alert('Invalid Details'); </script>";
	}
}
?>