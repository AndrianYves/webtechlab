<?php include 'inc/db.php'; ?>
<?php
  $sql = mysqli_query($db,"UPDATE users SET status = 'Rejected' WHERE id=".$_GET['id']."");
  header('location: allaccounts.php');
?>