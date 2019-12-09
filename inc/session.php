<?php
	session_start();
	include 'inc/db.php';;

	if(isset($_SESSION['users'])){
		$sql = mysqli_query($db, "SELECT * FROM users where `idnumber` = '".$_SESSION['users']."'");
		$user = mysqli_fetch_assoc($sql);
	}
?>