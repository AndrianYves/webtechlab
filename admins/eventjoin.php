<?php include 'inc/db.php'; ?>
<?php
	session_start();
	$sql1 = mysqli_query($db,"UPDATE activityinvitation SET status = 'Accepted' WHERE userID=".$_GET['id']."");

	$_SESSION['success'] = 'Activity request join Accepted';
	header('location: activities.php');
?>