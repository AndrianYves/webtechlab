<?php
session_start();
  include 'inc/db.php';
  if(isset($_POST['login'])){
    $idnumber = $_POST['idnumber'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE idnumber= '$idnumber'";
    $query = $db->query($sql);

    if($query->num_rows < 1){
      echo "<script>alert('Invanlid ID Number/Password');</script>";
    }
    else{
      $row = $query->fetch_assoc();
      if(password_verify($password, $row['password'])){
        if(empty($row['status'])) {
          header('location: invalid.php');
        } else {
          $_SESSION['users'] = $row['idnumber'];
          header('location: index.php');
        }
      }
      else{
        echo "<script>alert('Invanlid ID Number/Password');</script>";
      }
    }
  }
 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <title>Login Page</title>
  </head>
  <body>

    <!-- Main navigation -->
    <header>
    <!-- Mask & flexbox options-->
    <div class="justify-content-center align-items-center">
      <!-- Content -->
      <div class="container" style="margin-top: 100px;">
        <!--Grid row-->
        <div class="row pt-lg-3 mt-lg-3">
          <!--Grid column-->
          <div class="col-md-6 mb-5 mt-md-0 mt-5 black-text text-center text-md-left wow fadeInLeft"
            data-wow-delay="0.3s">
            <h1 class="h1-responsive font-weight-bold">OrgIT</h1>
            <hr class="hr-light">
            <h6 class="mb-3">About...</h6>
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">
            <!--Form-->
            <div class="card wow fadeInRight" data-wow-delay="0.3s">
              <div class="card-body z-depth-2">
                <!--Header-->
                <div class="text-center">
               
              </div>
                <div class="text-center">
                  <h3 class="dark-grey-text">
                    <strong>Please Login</strong>
                  </h3>
                  <hr>
                </div>
                <form action="login.php" method="POST" class="p-2">
                <!--Body-->
                  <input type="text" id="idnumber" name="idnumber" placeholder="ID Number" class="form-control mb-4" placeholder="ID Number">

                  <!-- Password -->
                  <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password">
                <!--Textarea with icon prefix-->
                <div class="text-center mt-3">
                  <button type="submit" class="btn btn-outline-primary wave effects" name="login">Login</button>
                  <hr>
                </form>
                </div>
              </div>
            </div>
            <!--/.Form-->
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </div>
      <!-- Content -->
    </div>
    <!-- Mask & flexbox options-->
    </header>
    <!-- Main navigation -->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>

  </body>
</html>

<?php include 'inc/scripts.php'; ?>
</body>

</html>