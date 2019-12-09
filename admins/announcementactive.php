<?php include 'inc/db.php'; ?>
<?php
  $sql = mysqli_query($db,"UPDATE post SET status = 'Active' WHERE id=".$_GET['id']."");
  header('location: announcements.php');
?>