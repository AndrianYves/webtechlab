<?php include 'inc/header.php'; 
$link = "Poll";
?>

<body>
      <?php include 'inc/navbar.php'; ?>
<?php
error_reporting(0);
  if(isset($_POST['submit'])){ 
    $sql = mysqli_query($db, "SELECT * FROM pollquestion");
    $sql_array = array();
    $user = $_POST['user'];
    while ($row = mysqli_fetch_array($sql)) {
      $ques = $row['id'];
      if (isset($_POST[$ques])) {
        $questions = $_POST[$ques];
        $sql_array[]="INSERT INTO pollanswers(questionID, choiceID, userID) VALUES 
         ('$ques', '$questions', '$user')";
      }
    }

    foreach($sql_array as $sql_row){
        $db->query($sql_row);
      }
  }

?>
 <main class="mt-5 pt-5">
    <div class="container">




      <!--Section: Cards-->
      <section class="pt-5">
      <?php
        $sql3 = mysqli_query($db, "SELECT * FROM pollquestion join pollanswers on pollquestion.id = pollanswers.questionID WHERE pollanswers.userID = '".$user['id']."'");?>

        <form method="POST" action="poll.php">
         <?php
            $sql = mysqli_query($db, "SELECT * FROM pollquestion");

            while ($row = mysqli_fetch_array($sql)) {

                  ?>
        <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
          <!--Grid column-->
          <div class="col-lg-12 col-xl-12 mb-4">
            <h3 class="mb-3 font-weight-bold dark-grey-text">
              <strong><?php echo ucfirst($row['question']);?></strong>
            </h3>

                   <?php   $sql1 = mysqli_query($db, "SELECT * FROM pollchoices where questionID = '".$row['id']."'");

                      while ($row1 = mysqli_fetch_array($sql1))  { 

                         $input = '<div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" id="'.$row1['id'].'" name="'.$row['id'].'" value="'.$row1['id'].'"><label class="custom-control-label" for="'.$row1['id'].'">'.ucfirst($row1['choice']).'</label></div>
                         
                         ';
                        ?>

            <?php echo $input;?>

            <?php } ?>
          </div>
          <!--Grid column-->

        </div>
        <hr class="mb-5">
                       <?php  } ?>
                       <input class="form-check-input" type="hidden" name="user" value="<?php echo $user['id'];?>">
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-outline-success waves-effect" name="submit" id="submit"><i class="nav-icon fas fa-vote-yea"></i>Vote</button></form>
                  </div>
                </div>

      </section>
      <!--Section: Cards-->

    </div>
  </main>
  <!--Main layout-->
  <?php include 'inc/footer.php'; ?>



<?php include 'inc/scripts.php'; ?>
</body>

</html>
