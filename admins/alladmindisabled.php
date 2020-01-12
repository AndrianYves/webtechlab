<?php include 'inc/db.php'; ?>
<?php
  session_start();
  $sql = mysqli_query($db,"UPDATE accounts SET status = 'Disabled' WHERE username='".$_GET['username']."'");
  $_SESSION['error'][] = ''.$_GET['username'].' Account Disabled';
  header('location: allaccounts.php');
?>