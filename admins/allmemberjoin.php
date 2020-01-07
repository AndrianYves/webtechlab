<?php include 'inc/db.php'; ?>
<?php

	session_start();
	$sql = mysqli_query($db, "SELECT * FROM semesterdate");
	$date = mysqli_fetch_assoc($sql);
	$dateend = $date['semesterend'];

	$sql1 = mysqli_query($db,"UPDATE users SET status = 'Accepted', endofsem = '$dateend' WHERE id=".$_GET['id']."");
	//for saving uploaded images
    mkdir('../img/users/'.$_GET['id'], 0777, true);

	$_SESSION['success'] = 'Member Accepted';
	header('location: allaccounts.php');
?>