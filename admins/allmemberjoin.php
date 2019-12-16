<?php include 'inc/db.php'; ?>
<?php

	$sql = mysqli_query($db, "SELECT * FROM semesterdate");
	$date = mysqli_fetch_assoc($sql);
	$dateend = $date['semesterend'];

	$sql1 = mysqli_query($db,"UPDATE users SET status = 'Accepted', endofsem = '$dateend' WHERE id=".$_GET['id']."");
	header('location: allaccounts.php');
?>