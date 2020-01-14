<?php
	session_start();
	require_once 'inc/db.php';;
	date_default_timezone_set("Asia/Bangkok");
	
	if(isset($_SESSION['admin'])){
		$sql = mysqli_query($db, "SELECT * FROM accounts where `username` = '".$_SESSION['admin']."'");
		$user = mysqli_fetch_assoc($sql);
	} else {
		header('location: login.php');
		exit();
	}
	
?>