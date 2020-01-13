<?php 
  include 'inc/header.php'; 
  include 'inc/session.php';
  $link = "Activities";
?>

<body>
<?php include 'inc/navbar.php'; ?>
<?php

// error_reporting(0);
  if(isset($_POST['submit'])){ 
    $act = $_POST['act'];
    $choice = 'Joining';
    $userid = $_POST['user'];
    $sql = mysqli_query($db,"UPDATE activityinvitation SET choice = '$choice' WHERE activityID = '$act' and userID = '$userid'");

    $_SESSION['success'] = 'Request Join submitted.';
  }

  if(isset($_POST['submit1'])){ 
    $act = $_POST['act'];
    $choice = 'Not Joining';
    $userid = $_POST['user'];

    $sql = mysqli_query($db,"UPDATE activityinvitation SET choice = '$choice' WHERE activityID = '$act' and userID = '$userid'");

    $_SESSION['success'] = 'Not Joining.';
  }

    if(isset($_POST['submit3'])){ 
    $act = $_POST['act'];
    $choice = 'Cancelled';
    $userid = $_POST['user'];
    $sql = mysqli_query($db,"UPDATE activityinvitation SET choice = '$choice' WHERE activityID = '$act' and userID = '$userid'");

    $_SESSION['success'] = 'Cancelled.';
  }

?>
 <main class="mt-5 pt-5">
    <div class="container">
      <!--Section: Cards-->
      <section class="pt-5">
        <?php
          $sql = mysqli_query($db, "SELECT *, activities.id as actID from activities join activityinvitation on activities.id = activityinvitation.activityID where activityinvitation.userID = '".$user['id']."' and activities.status = 'Active' ORDER BY activities.deadline DESC");
          while ($row = mysqli_fetch_array($sql)) { ?>
            <?php if(strtotime($today) > strtotime($row['deadline'])): ?>
              <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-lg-12 col-xl-12 mb-4">
                  <h3 class="mb-3 font-weight-bold dark-grey-text">
                    <strong><?php echo ucfirst($row['title']);?></strong>
                  </h3>
                  <p><?php echo ucfirst($row['description']);?></p>
                    <?php
                      $sql2 = mysqli_query($db, "SELECT * FROM activityinvitation where activityID = '".$row['actID']."' and userID = '".$user['id']."' ");
                      while ($row2 = mysqli_fetch_array($sql2))  { 
                        if(empty($row2['choice'])){
                          $input = '<h4 style="color: green;">Ignored</h4>';
                        } elseif ($row2['choice'] == 'Joining'){
                          $input = '<h4 style="color: green;">Joined</h4><button class="btn-sm btn-outline-info waves-effect" disabled>'.$row2['status'].'</button>';
                        } else {
                          $input = '<h4 style="color: green;">Not Joining</h4>';
                        }
                        ?>
                        <?php echo $input;?>
                      <?php } ?>
                    <h6 class="mb-3 font-weight-bold dark-grey-text">
                      <strong>Poll Ended: <?php echo ucfirst($row['deadline']);?></strong>
                    </h6>
                </div>
                <!--Grid column-->
              </div>
            <?php else: ?>
              <?php if(empty($row['choice'])): ?>
              
                <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                  <!--Grid column-->
                  <div class="col-lg-12 col-xl-12 mb-4">
                    <h3 class="mb-3 font-weight-bold dark-grey-text">
                      <strong><?php echo ucfirst($row['title']);?></strong>
                    </h3>
                    <p><?php echo ucfirst($row['description']);?></p>

                    <div class="btn-group" role="group" aria-label="Basic example">
                      <form method="POST" action="activities.php">
                        <input class="form-check-input" type="hidden" name="user" value="<?php echo $user['id'];?>">
                        <input class="form-check-input" type="hidden" name="act" value="<?php echo $row['actID'];?>">
                        <button class="btn btn-outline-success waves-effect" name="submit" type="submit"><i class="nav-icon fas fa-vote-yea"></i>Join</button>
                      </form>
                      <form method="POST" action="activities.php">
                        <input class="form-check-input" type="hidden" name="user" value="<?php echo $user['id'];?>">
                        <input class="form-check-input" type="hidden" name="act" value="<?php echo $row['actID'];?>">
                        <button class="btn btn-outline-danger waves-effect" name="submit1" type="submit"><i class="nav-icon fas fa-vote-yea"></i>Not Join</button>
                       </form>
                    </div>

                  </div>
                  <!--Grid column-->
                </div>
                <div class="row">
                  <div class="col-6">
                                        <h6 class="mb-3 font-weight-bold dark-grey-text">
                      <strong>Deadline: <?php echo ucfirst($row['deadline']);?></strong>
                    </h6>
                  </div>
                </div>
                <hr class="mb-5">
                <?php else: ?>
                <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
                  <!--Grid column-->
                  <div class="col-lg-12 col-xl-12 mb-4">
                    <h3 class="mb-3 font-weight-bold dark-grey-text">
                      <strong><?php echo ucfirst($row['title']);?></strong>
                    </h3>
                    <p><?php echo ucfirst($row['description']);?></p>
                      <?php
                        $sql1 = mysqli_query($db, "SELECT * FROM activityinvitation where activityID = '".$row['actID']."' and userID = '".$user['id']."' ");
                        while ($row1 = mysqli_fetch_array($sql1))  { 
                          $input = ''.ucfirst($row1['choice']).'';
                          if($row1['choice'] == 'Joining'){

                            if (empty($row1['status'])){
                              $input2 = '<button class="btn-sm btn-outline-info waves-effect" disabled>Request join Pending</button><input class="form-check-input" type="hidden" name="user" value="'.$user['id'].'"><input class="form-check-input" type="hidden" name="act" value="'.$row['actID'].'"><button class="btn-sm btn btn-outline-danger waves-effect" name="submit3" type="submit"><i class="nav-icon fas fa-vote-yea"></i>Cancel?</button>';
                            } elseif ($row1['status'] == 'Accepted') {
                              $input2 = '<button class="btn-sm btn-outline-success waves-effect" disabled><i class="nav-icon fas fa-check"></i>Request join accepted</button><input class="form-check-input" type="hidden" name="user" value="'.$user['id'].'"><input class="form-check-input" type="hidden" name="act" value="'.$row['actID'].'"><button class="btn-sm btn btn-outline-danger waves-effect" name="submit3" type="submit"><i class="nav-icon fas fa-vote-yea"></i>Cancel?</button>';
                            } else {
                              $input2 = '<button class="btn-sm btn-outline-danger waves-effect" disabled><i class="nav-icon fas fa-times"></i>Request join rejected</button>';
                            }

                            $input1 = '<form method="POST" action="activities.php">"'.$input2.'"</form>';
                          } else {
                            $input1 = '<form method="POST" action="activities.php"><input class="form-check-input" type="hidden" name="user" value="'.$user['id'].'"><input class="form-check-input" type="hidden" name="act" value="'.$row['actID'].'"><button class="btn-sm btn btn-outline-success waves-effect" name="submit" type="submit"><i class="nav-icon fas fa-vote-yea"></i>Join?</button></form>';
                          }
                          ?>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><?php echo $input;?></span>
                            </div>
                            <?php echo $input1;?>
                          </div>

                        <?php } ?>
                    <h6 class="mb-3 font-weight-bold dark-grey-text">
                      <strong>Deadline: <?php echo ucfirst($row['deadline']);?></strong>
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

  