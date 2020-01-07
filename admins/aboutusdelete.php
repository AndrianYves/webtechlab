<?php include 'inc/db.php'; ?>
<?php
  session_start();
  $sql = mysqli_query($db,"DELETE FROM aboutus WHERE id=".$_GET['id']."");
  $_SESSION['success'] = 'Content Deleted';
  header('location: page.php');
?>