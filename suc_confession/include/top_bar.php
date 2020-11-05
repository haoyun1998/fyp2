<div class="header">
		<a href="index.php" class="title">SUC Confession</a>
<?php
if($_SESSION['alogin'] == ''){
?>
		<a href="#" class="right" onclick="document.getElementById('login').style.display='block'">Login</a>
		<a href="#" class="right" onclick="document.getElementById('register').style.display='block'">Register</a>
<?php
} else {
?>
		<a href="include/logout.php" class="right" onclick="logout()">Logout</a>
		<a href="add_post.php" class="right">Add New Post</a>		
<?php
}
?>

		<div id="login" class="modal">
		  	<form class="modal-content animate" method="post">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('login').style.display='none'" class="close">&times;</span>		      
			    </div>

			    <div class="container">
			      <label><b>Username</b></label>
			      <input type="text" placeholder="Enter Username" name="Lusername" required value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];} ?>">

			      <label><b>Password</b></label>
			      <input type="password" placeholder="Enter Password" name="Lpassword" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];} ?>" required>
			        
			      <button type="submit" name="Lsubmit">Login</button>
			      <label>
			        <input type="checkbox" checked="checked" name="remember"> Remember me
			      </label>
			    </div>

			    <div class="container" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
			      <span class="psw">Forgot <a href="#">password?</a></span>
			    </div>
		  	</form>
		</div>	

		<div id="register" class="modal">
		  	<form class="modal-content animate" method="post">
			    <div class="imgcontainer">
			      <span onclick="document.getElementById('register').style.display='none'" class="close">&times;</span>		      
			    </div>

			    <div class="container">
			      <label><b>Username</b></label>
			      <input type="text" placeholder="Enter Username" name="uname" required>

			      <label><b>E-mail</b></label>
			      <input type="text" placeholder="Enter E-mail" name="uname" required>

			      <label><b>Password</b></label>
			      <input type="password" placeholder="Enter Password" name="psw" required>

			      <label><b>Confirm Password</b></label>
			      <input type="password" placeholder="Enter Confirm Password" name="psw" required>
			        
			      <button type="submit">Login</button>			 
			    </div>

			    <div class="container" style="background-color:#f1f1f1">
			      <button type="button" onclick="document.getElementById('register').style.display='none'" class="cancelbtn">Cancel</button>
			      <span class="psw">Forgot <a href="#">password?</a></span>
			    </div>
		  	</form>
		</div>	
	</div>

	<script>
	// Get the modal
	var modal = document.getElementById('login');
	var modal2 = document.getElementById('register');

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    } else if (event.target == modal2) {
	    	modal2.style.display = "none";
	    }
	}
	</script>