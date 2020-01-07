<?php include 'inc/db.php'; ?>
<?php
session_start();
  $sql = mysqli_query($db,"UPDATE pollquestion SET status = 'Inactive' WHERE id=".$_GET['id']."");
  $_SESSION['success'] = 'Question Inactive';
  header('location: poll.php');
?>