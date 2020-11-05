<?php
session_start(); 
$_SESSION = array();
unset($_SESSION['alogin']);
session_destroy(); // destroy session
header("location:../index.php"); 
?>