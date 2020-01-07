<?php include 'inc/db.php'; ?>
<?php
	session_start();
  $sql = mysqli_query($db,"UPDATE post SET status = 'Active' WHERE id=".$_GET['id']."");
  $_SESSION['success'] = 'Announcement Active';
  header('location: announcements.php');
?>