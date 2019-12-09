<?php include 'inc/db.php'; ?>
<?php
  $sql = mysqli_query($db,"UPDATE accounts SET status = 'Enabled' WHERE id=".$_GET['id']."");
  header('location: users.php');
?>