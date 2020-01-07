<?php include 'inc/db.php'; ?>
<?php
  session_start();
  $sql = mysqli_query($db,"UPDATE post SET status = 'Inactive' WHERE id=".$_GET['id']."");
  $_SESSION['error'] = 'Announcement Inactive';
  header('location: announcements.php');
?>