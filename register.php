<?php
  include 'inc/db.php';
 if (isset($_POST['submit'])) {
  $fname=$_POST['firstname'];
  $lname=$_POST['lastname'];
  $idnum=$_POST['idnumber'];
  $course=$_POST['course'];
  $year=$_POST['year'];
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

  $sql="INSERT INTO users(firstname, lastname, idnumber, course, year, email, password) VALUES 
  ('$fname', '$lname', '$idnum', '$course', '$year', '$email', '$hashedPassword')";

   mysqli_query($db, $sql);
    echo "<script>alert('Thank You!'); window.location='verifying.php'</script>";
}

?>
<?php include 'inc/header.php'; ?>
<body>
  <?php include 'inc/navbar.php'; ?>
  <main class="mt-5 pt-5">
    <div class="container">

  <!-- ================ contact section start ================= -->
  <section class="contact-section section_padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Register</h2>
        </div>
        <div class="col-lg-12">
          <form class="form-contact contact_form" action="register.php" method="post" id="contactForm"
            novalidate="novalidate">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="idnumber" id="ID Number" type="text" placeholder='Enter your ID Number'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="password" type="password" placeholder='Enter password'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="firstname" type="text" placeholder='Enter Firstname'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="lastname" type="text" placeholder='Enter Lastname'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="course" type="text" placeholder='Enter Course'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="year" type="text" placeholder='Enter Year'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="email" type="text" placeholder='Enter Email'>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button-contactForm btn_1" name="submit">Submit </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->
    </div>
  </main>
  <?php include 'inc/footer.php'; ?>



<?php include 'inc/scripts.php'; ?>
</body>

</html>