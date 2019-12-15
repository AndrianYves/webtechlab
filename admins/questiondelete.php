<?php include 'inc/db.php'; ?>
<?php
  $sql = mysqli_query($db, "DELETE FROM pollchoices WHERE id=".$_GET['id']."");
  $sql2 = mysqli_query($db, "DELETE FROM pollquestion WHERE id=".$_GET['id']."");
  header('location: poll.php');
?>