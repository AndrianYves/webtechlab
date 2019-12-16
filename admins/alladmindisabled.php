<?php include 'inc/db.php'; ?>
<?php
  $sql = mysqli_query($db,"UPDATE accounts SET status = 'Disabled' WHERE id=".$_GET['id']."");
  header('location: allaccounts.php');
?>