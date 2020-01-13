<?php include 'inc/db.php'; ?>
<?php
	session_start();
	$sql1 = mysqli_query($db,"UPDATE activities SET status = 'Inactive' WHERE id=".$_GET['id']."");

	$_SESSION['error'][] = 'Activity Inactive';
	header('location: activities.php');
?>