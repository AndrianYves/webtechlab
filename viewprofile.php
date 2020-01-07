<?php 
include 'inc/header.php'; 
include 'inc/session.php';
$link = "Profile";
?>
<body>
<?php include 'inc/navbar.php'; ?>
      <!--Main layout-->
  <main class="mt-5 pt-2">
    <div class="container mt-2">
      <div class="pt-5 col-lg-4 col-md-12 mb-4">
        <div class="card">
          <!--Card image-->
          <div class="view overlay">
            <div class="embed-responsive embed-responsive-16by9 rounded-top">
              <?php if(!empty($user['image'])): ?>
                <image class="embed-responsive-item" src="img/users/<?php echo $user['id']; ?>/<?php echo $user['image']; ?>" allowfullscreen=""></image>
              <?php else: ?>
                <image class="embed-responsive-item" src="img/stock.jpg" allowfullscreen=""></image>
              <?php endif ?>
            </div>
          </div>
          <!--Card content-->
          <div class="card-body">
            <!--Title-->
            <h4 class="card-title"><?php echo $user['firstname']. ' '.$user['lastname']; ?></h4>
            <!--Text-->
            <p class="card-text"><strong><?php echo $user['idnumber']; ?></strong></p>
            <p class="card-text"><?php echo $user['email']; ?></p>
            <p class="card-text"><?php echo $user['course']. ' - '.$user['year']; ?></p>
            <button class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#changepassword">Change Password</button>
            <button class="btn btn-success btn-sm waves-effect" data-toggle="modal" data-target="#photo">Upload Image</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Change Password -->
    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <p class="heading lead">Change Password</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>

          <!--Body-->
          <div class="modal-body">
            <form action="viewprofile.php" method="POST" class="p-2">
              <input type="hidden" name="id" class="form-control mb-4" value="<?php echo $user['idnumber']; ?>">
              <input type="password" name="oldpassword" class="form-control mb-4" placeholder="Old Password">
              <input type="password" name="newpassword" class="form-control mb-4" placeholder="New Password">
              <input type="password" name="confirmpassword" class="form-control mb-4" placeholder="Confirm Password">
          </div>

          <!--Footer-->
          <div class="modal-footer justify-content-center">
            <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            <button class="btn btn-primary waves-effect" name="change" id="change">Change Password</button>

          </div>
          </form>
          <?php
            if (isset($_POST['change'])) {
              $user=$_POST['id'];
              $sql1 = mysqli_query($db, "SELECT * FROM users where `idnumber` = '$user'");
              $row = mysqli_fetch_assoc($sql1);
              $oldpassword=$_POST['oldpassword'];
              $newpassword=$_POST['newpassword'];
              $confirmpassword=$_POST['confirmpassword'];
              $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);

              if(password_verify($oldpassword, $row['password'])){
                if ($newpassword == $confirmpassword) {
                  $sql = mysqli_query($db,"UPDATE users SET password = '$hashedPassword' WHERE idnumber = '$user'");
                  $_SESSION['success'] = 'Change Password Successful';
                } else {
                  $_SESSION['error'] = 'Password does not matched';
                }
              } else{
                $_SESSION['error'] ='Invalid Old Password';
              }
            }
          ?>
        </div>
        <!--/.Content-->
      </div>
    </div><!--/. Change Password -->

      <!-- Change photo -->
    <div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Header-->
          <div class="modal-header">
            <p class="heading lead">Change Password</p>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>

          <!--Body-->
          <div class="modal-body">
            <form action="viewprofile.php" method="POST" class="p-2" enctype="multipart/form-data">
              <input type="hidden" name="idphoto" class="form-control mb-4" value="<?php echo $user['id']; ?>">
              <div class="md-form mt-0">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image" aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label text-left" for="image">Upload Profile Photo</label>
                  </div>
                </div>
              </div>
          </div>

          <!--Footer-->
          <div class="modal-footer justify-content-center">
            <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            <button class="btn btn-primary waves-effect" name="upload" id="upload">Upload</button>

          </div>
          </form>
          <?php
            if (isset($_POST['upload'])) {
              $user=$_POST['idphoto'];
              
              move_uploaded_file($_FILES["image"]["tmp_name"],"img/users/$user/".$_FILES["image"]["name"]);
              $image = $_FILES['image']['name'];

              $sql = mysqli_query($db,"UPDATE users SET image = '$image' WHERE id = '$user'");
              $_SESSION['success'] = 'Upload image';
            }
          ?>
        </div>
        <!--/.Content-->
      </div>
    </div><!--/ .Change photo -->

  </main> <!-- banner part start-->
       
<?php include 'inc/footer.php'; ?>
<?php include 'inc/scripts.php'; ?>
</body>
</html>