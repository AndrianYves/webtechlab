<?php
  include 'inc/db.php';
  session_start();
  
  if(isset($_POST['login'])){
    $error = false;
    if(empty($_POST['username'])) {
      $error = true;
      $_SESSION['error'][] = 'Username is required.';
    } else if (preg_match("/([%\$#\*]+)/", $_POST['username'])) {
      $error = true;
      $_SESSION['error'][] = 'Username entered was not 6 digits long.';
    } else {
      $username = $_POST['username'];
    }

    if(empty($_POST['password'])) {
      $error = true;
      $_SESSION['error'][] = 'Password is required.';
    } else {
      $password = $_POST['password'];
    }

    if(!$error){
      $sql = "SELECT * FROM accounts WHERE username= '$username'";
      $query = $db->query($sql);

      if($query->num_rows < 1){
        $_SESSION['error'][] ='Invanlid Username/Password';
      } else {
        $row = $query->fetch_assoc();
        if(password_verify($password, $row['password'])){
           if($row['status'] == 'Disabled') {
            $_SESSION['error'][] ='Sorry. Your account has been disabled';
          } else {
            $_SESSION['admin'] = $row['username'];
            header('location: index.php');
          }
        } else {
          $_SESSION['error'][] ='Invanlid Username/Password';
        }
      }
    }





  } 
?>
<?php include 'inc/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>Webtech</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
          </div>
          <!-- /.col -->

        </div>


      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- ./wrapper -->
<?php include 'inc/scripts.php'; ?>

</body>
</html>
