<?php
	session_start();
	include 'inc/db.php';;

 	date_default_timezone_set("Asia/Bangkok");
 	$today = date('Y-m-d');
 	error_reporting(0);
	if(isset($_SESSION['users'])){
		$sql = mysqli_query($db, "SELECT * FROM users where `idnumber` = '".$_SESSION['users']."'");
		$user = mysqli_fetch_assoc($sql);
	}
?>