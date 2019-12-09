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
        if($row['status'] == 'Rejected') {
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
<?php include 'inc/header.php'; ?>
<body>
    <div class="body_bg">

  <!-- ================ contact section start ================= -->
  <section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Login</h2>
        </div>
        <div class="col-lg-12">
          <form class="form-contact contact_form" action="login.php" method="post" id="contactForm"
            novalidate="novalidate">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="idnumber" id="ID Number" type="text" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your ID Number'" placeholder='Enter your ID Number'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="password" type="password" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter password'" placeholder='Enter password'>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button-contactForm btn_1" name="login">login </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

  <?php include 'inc/footer.php'; ?>
    </div>


<?php include 'inc/scripts.php'; ?>
</body>

</html>