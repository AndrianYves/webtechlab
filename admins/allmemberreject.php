<?php include 'inc/db.php'; ?>
<?php
session_start();
  $sql = mysqli_query($db,"UPDATE users SET status = 'Rejected' WHERE id=".$_GET['id']."");
    $_SESSION['error'][] = 'Member Rejected';
  header('location: allaccounts.php');
?>