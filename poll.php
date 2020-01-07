<?php 
  include 'inc/header.php'; 
  include 'inc/session.php';
  $link = "Poll";
?>

<body>
<?php include 'inc/navbar.php'; ?>
<?php

// error_reporting(0);
  if(isset($_POST['submit'])){ 
    $ques = $_POST['ques'];
    $ans = $_POST['ans'];
    $user = $_POST['user'];
    $sql = mysqli_query($db,"UPDATE pollanswers SET choiceID = '$ans' WHERE questionID = '$ques' and userID = '$user'");

    $_SESSION['success'] = 'Vote Submitted';
  }

?>
 <main class="mt-5 pt-5">
    <div class="container">
      <!--Section: Cards-->
      <section class="pt-5">
        <?php
          $sql = mysqli_query($db, "SELECT *, pollquestion.id as quesID, pollanswers.choiceID as choiceID, pollquestion.endofdate as endDate from pollquestion left join pollanswers on pollquestion.id = pollanswers.questionID where pollanswers.userID = '".$user['id']."' and pollquestion.status = 'Active' ORDER BY pollquestion.endofdate DESC");
          while ($row = mysqli_fetch_array($sql)) { ?>
            <?php if(strtotime($today) > strtotime($row['endDate'])): ?>
              <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-lg-12 col-xl-12 mb-4">
                  <h3 class="mb-3 font-weight-bold dark-grey-text">
                    <strong><?php echo ucfirst($row['question']);?></strong>
                  </h3>
                    <?php
                      $sql2 = mysqli_query($db, "SELECT *, pollanswers.choiceID as ans FROM pollanswers left join pollchoices on pollanswers.choiceID = pollchoices.id where pollanswers.questionID = '".$row['quesID']."' and pollanswers.userID = '".$user['id']."' ");
                      while ($row2 = mysqli_fetch_array($sql2))  { 
                        if(empty($row2['ans'])){
                          $input = '<h4 style="color: green;">Not Voted</h4>';
                        } else {
                          $input = '<h4 style="color: green;">'.ucfirst($row2['choice']).'</h4>';
                        }
                        ?>
                        <?php echo $input;?>
                      <?php } ?>
                    <h6 class="mb-3 font-weight-bold dark-grey-text">
                      <strong>Poll Ended: <?php echo ucfirst($row['endofdate']);?></strong>
                    </h6>
                </div>
                <!--Grid column-->
              </div>
            <?php else: ?>
              <?php if(empty($row['choiceID'])): ?>
              <form method="POST" action="poll.php">
                <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                  <!--Grid column-->
                  <div class="col-lg-12 col-xl-12 mb-4">
                    <h3 class="mb-3 font-weight-bold dark-grey-text">
                      <strong><?php echo ucfirst($row['question']);?></strong>
                    </h3>
                      <?php
                        $sql1 = mysqli_query($db, "SELECT * FROM pollchoices where questionID = '".$row['quesID']."'");
                        while ($row1 = mysqli_fetch_array($sql1))  { 
                          $input = '<div class="custom-control custom-radio custom-control-inline"><input type="radio" class="custom-control-input" id="'.$row1['id'].'" name="ans" value="'.$row1['id'].'"><label class="custom-control-label" for="'.$row1['id'].'">'.ucfirst($row1['choice']).'</label></div>';
                          ?>
                          <?php echo $input;?>
                        <?php } ?>

                  </div>
                  <!--Grid column-->
                </div>
                <input class="form-check-input" type="hidden" name="ques" value="<?php echo $row['id'];?>">
                <input class="form-check-input" type="hidden" name="user" value="<?php echo $user['id'];?>">
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-outline-success waves-effect" name="submit" id="submit"><i class="nav-icon fas fa-vote-yea"></i>Vote</button></form>
                                        <h6 class="mb-3 font-weight-bold dark-grey-text">
                      <strong>Poll will end at <?php echo ucfirst($row['endofdate']);?></strong>
                    </h6>
                  </div>
                </div>
                <hr class="mb-5">
                <?php else: ?>
                <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                  <!--Grid column-->
                  <div class="col-lg-12 col-xl-12 mb-4">
                    <h3 class="mb-3 font-weight-bold dark-grey-text">
                      <strong><?php echo ucfirst($row['question']);?></strong>
                    </h3>
                      <?php
                        $sql1 = mysqli_query($db, "SELECT * FROM pollanswers join pollchoices on pollanswers.choiceID = pollchoices.id where pollanswers.questionID = '".$row['quesID']."' and pollanswers.userID = '".$user['id']."' ");
                        while ($row1 = mysqli_fetch_array($sql1))  { 
                          $input = '<h4 style="color: green;">'.ucfirst($row1['choice']).'</h4>';
                          ?>
                          <?php echo $input;?>
                        <?php } ?>
                    <h6 class="mb-3 font-weight-bold dark-grey-text">
                      <strong>Poll will end at <?php echo ucfirst($row['endofdate']);?></strong>
                    </h6>
                  </div>
                  <!--Grid column-->
                </div>
                <?php endif ?>

           <?php endif ?>

          <?php } ?>
      </section>
      <!--Section: Cards-->

    </div>
  </main>
  <!--Main layout-->
<?php include 'inc/footer.php'; ?>

<?php include 'inc/scripts.php'; ?>
</body>

</html>
