<?php include 'inc/db.php'; ?>
<?php
  session_start();
  $sql = mysqli_query($db,"UPDATE accounts SET status = 'Enabled' WHERE username='".$_GET['username']."'");
  $_SESSION['success'] = ''.$_GET['username'].' Account Enabled';
  header('location: allaccounts.php');
?>