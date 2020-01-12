<?php 
include 'inc/header.php'; 
include 'inc/session.php';
$link = "Home";
$error = false;

  if (isset($_POST['signup'])) {
    
    if (empty($_POST['firstname'])) {
      $error = true;
      $_SESSION['error'][] = 'Firstname is required.';
    } else if (preg_match("/([%\$#\*]+)/", $_POST['firstname'])) {
      $error = true;
      $_SESSION['error'][] = 'Firstname is invalid.';
    } else {
      $fname = test_input($_POST['firstname']);
    }

    if (empty($_POST['lastname'])) {
      $error = true;
      $_SESSION['error'][] = 'Lastname is required.';
    } else if (preg_match("/([%\$#\*]+)/", $_POST['lastname'])) {
      $error = true;
      $_SESSION['error'][] = 'Lastname is invalid.';
    } else {
      $lname = test_input($_POST['lastname']);
    }

    if(empty($_POST['idnumber'])) {
      $error = true;
      $_SESSION['error'][] = 'The ID number is required.';
    } else if(!is_numeric($_POST['idnumber'])) {
      $error = true;
      $_SESSION['error'][] = 'The ID number entered was not numeric.';
    } else if(strlen($_POST['idnumber']) < 6) {
      $error = true;
      $_SESSION['error'][] = 'The ID number entered was not 6 digits long.';
    } else {
      $idnum = test_input($_POST['idnumber']);
    }

    if (empty($_POST['course'])) {
      $error = true;
      $_SESSION['error'][] = 'Course is required.';
    } else {
      $course = test_input($_POST['course']);
    }

    if (empty($_POST['year'])) {
      $error = true;
      $_SESSION['error'][] = 'Year is required.';
    } else if(strlen($_POST['year']) > 5 || strlen($_POST['year']) < 1) {
      $error = true;
      $_SESSION['error'][] = 'The year entered not valid.';
    } else {
      $year = test_input($_POST['year']);
    }

    $sql1 = mysqli_query($db, "SELECT * FROM users where email = '".$_POST['email']."' ");

    if (empty($_POST['email'])) {
      $error = true;
      $_SESSION['error'][] = 'Email is required.';
    } else if (mysqli_num_rows($sql1) > 0) {
      $error = true;
      $_SESSION['error'][] = 'Email already exist.'; 
    } else {
      $email = test_input($_POST['email']);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $_SESSION['error'][] = 'Invalid email format.'; 
      }
    }

    $pass=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    if ($pass == $confirmpassword) {
      $sql="INSERT INTO users(firstname, lastname, idnumber, course, year, email, password) VALUES ('$fname', '$lname', '$idnum', '$course', '$year', '$email', '$hashedPassword')";
    } else {
      $error = true;
      $_SESSION['error'][] = 'Password not matched';
    }

    if(!$error){
      mysqli_query($db, $sql);
      session_start();
      $_SESSION['success'] = 'Registration Successful';
      header('location: verifying.php');
    }

  }

  if(isset($_POST['login'])){
    if(empty($_POST['idnumber'])) {
      $error = true;
      $_SESSION['error'][] = 'The ID number is required.';
    } else if(!is_numeric($_POST['idnumber'])) {
      $error = true;
      $_SESSION['error'][] = 'The ID number entered was not numeric.';
    } else if(strlen($_POST['idnumber']) < 6) {
      $error = true;
      $_SESSION['error'][] = 'The ID number entered was not 6 digits long.';
    } else {
      $idnumber = test_input($_POST['idnumber']);
    }

    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE idnumber= '$idnumber'";
    $query = $db->query($sql);

    if($query->num_rows < 1){
      $_SESSION['error'][] ='Invanlid ID Number/Password';
    } else {
      $row = $query->fetch_assoc();
      if(password_verify($password, $row['password'])){
        if(empty($row['status'])) {
          $_SESSION['error'][] = 'Your account is not yet activated by the administrator.';
        } elseif($row['status'] == 'Rejected') {
            $_SESSION['error'][] ='Sorry. Your account has been Rejected.';
        } else {
            $sql1 = mysqli_query($db, "SELECT * FROM semesterdate");
            $date = mysqli_fetch_assoc($sql1);
            $dateend = strtotime($date['semesterend']);
            $today= strtotime(date('Y-m-d'));

          if($dateend < $today) {
            $_SESSION['renewing'] = $row['idnumber'];
            header('location: expired.php');
          } else {
            if(!$error){
              $_SESSION['users'] = $row['idnumber'];
              $_SESSION['success'] ='Login Success';
              header('location: viewprofile.php');
            }
          }
        }
      } else {
        $_SESSION['error'][] ='Invanlid ID Number/Password';
      }
    }
  }

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

?>
<body>
 <?php include 'inc/navbar.php'; ?>
  <!--Main layout-->
  <main class="mt-5 pt-5">

    <div class="container mt-2">

      <section class="card blue-gradient wow fadeIn animated" id="intro" style="visibility: visible; animation-name: fadeIn;">

        <!-- Content -->
        <div class="card-body text-white text-center py-5 px-5 my-5">
        <?php
          $sql = mysqli_query($db, "SELECT * FROM maincontent");
          $content = mysqli_fetch_assoc($sql);
        ?>
          <h1 class="mb-4">
            <strong><?php echo $content['title'];?></strong>
          </h1>
          <p>
            <strong><?php echo $content['content'];?></strong>
          </p>

        </div>
        <!-- Content -->
      </section>
<br>
      <section>
        <h3 class="h3 text-center mb-5">About Us</h3>

        <!--Grid row-->
        <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">

          <!--Grid column-->
          <div class="col-lg-12 col-md-12 px-4">
              <?php
                $sql1 = mysqli_query($db, "SELECT * FROM aboutus");
                while ($aboutus = mysqli_fetch_array($sql1)) {
              ?>
            <div class="row">
              <div class="col-12">
                <h5 class="feature-title"><?php echo $aboutus['title'];?></h5>
                <p class="grey-text"><?php echo $aboutus['title'];?></p>
              </div>
            </div>

            <div style="height:30px"></div>
             <?php } ?>

          </div>
          <!--/Grid column-->
        </div>
        <!--/Grid row-->

      </section>

      <section>
        <?php
          $sql2 = mysqli_query($db, "SELECT * FROM visionmission");
          $visionmission = mysqli_fetch_assoc($sql2);
        ?>
        <!-- Heading & Description -->
        <div class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
          <!--Section heading-->
          <h3 class="h3 text-center">Vision</h3>
          <!--Section description-->
          <p class="text-center"><?php echo $visionmission['vision'];?>.</p>
        </div>
        <!-- Heading & Description -->
      </section>

        <section>
        <!-- Heading & Description -->
        <div class="wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
          <!--Section heading-->
          <h3 class="h3 text-center">Mission</h3>
          <!--Section description-->
          <p class="text-center"><?php echo $visionmission['mission'];?>.</p>
        </div>
        <!-- Heading & Description -->
      </section>
    </div>

  <!-- Sign Up -->
  <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Sign Up</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
            <form class="form-contact contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input required class="form-control" name="idnumber" id="ID Number" type="text" placeholder='Enter your ID Number'>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input required class="form-control" name="email" type="text" placeholder='Enter Email'>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input required class="form-control" name="password" type="password" placeholder='Enter password'>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input required class="form-control" name="confirmpassword" type="password" placeholder='Confirm password'>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input required class="form-control" name="firstname" type="text" placeholder='Enter Firstname'>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input required class="form-control" name="lastname" type="text" placeholder='Enter Lastname'>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input required class="form-control" name="course" type="text" placeholder='Enter Course'>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input required class="form-control" name="year" type="number" placeholder='Enter Year'>
                  </div>
                </div>
              </div>
        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
          <button class="btn btn-primary waves-effect" name="signup" id="signup">Sign Up</button>
        </div>
        </form>
      </div>
      <!--/.Content-->
    </div>
  </div>

  <!-- Login -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
      <!--Content-->
      <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
          <p class="heading lead">Login</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="p-2">
            <input type="text" id="idnumber" name="idnumber" placeholder="ID Number" class="form-control mb-4" placeholder="ID Number">

            <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password">

        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
          <button class="btn btn-primary waves-effect" name="login" id="login">Login</button>
        </div>
        </form>
      </div>
      <!--/.Content-->
    </div>
  </div>

  </main>
  <!--/. main-->

<?php include 'inc/footer.php'; ?>
<?php include 'inc/scripts.php'; ?>
</body>

</html>