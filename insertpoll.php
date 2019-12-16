<?php
include 'inc/session.php';;

$sql = mysqli_query($db, "SELECT * FROM pollquestion");
    $sql_array = array();
    $user1 = $user['id'];
    $user2 = $_POST[$user1];
    while ($row = mysqli_fetch_array($sql)) {
      $ques = $row['id'];
      if (isset($_POST[$ques])) {
        $questions = $_POST[$ques];
        $sql_array[]="INSERT INTO pollanswers(questionID, userID) VALUES 
         ('$ques', '$user2')";
      }
    }

    foreach($sql_array as $sql_row){
        $db->query($sql_row);
      }

?>