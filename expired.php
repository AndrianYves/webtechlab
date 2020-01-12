<?php include 'inc/header.php';
    include 'inc/db.php'; ?>

<body>
  <?php include 'inc/navbar.php'; 
  session_start();?>

<?php  
  if(isset($_SESSION['renewing'])){
    if(isset($_POST['renew'])){
      $sql = mysqli_query($db,"UPDATE users SET status = 'Renewing' WHERE `idnumber` = '".$_SESSION['renewing']."'");
      session_destroy();
      header('location: verifying.php');
    }
  } else {
    header('location: index.php');
    exit();
  }

  ?>

  <main class="mt-5 pt-5">
    <div class="container">

      <!--Section: Jumbotron-->
      <section class="card blue-gradient wow fadeIn" id="intro">

        <!-- Content -->
        <div class="card-body text-white text-center py-5 px-5 my-5">

          <h1 class="mb-4">
            <strong>Semester ends all of accounts will be disabled if your willing to renew your acccount click renew.</strong>
          </h1>
        <form action="expired.php" method="POST" class="p-2">

        <div class="text-center mt-3">
          <button type="submit" class="btn btn-success wave effects" name="renew">Renew</button>
          <hr>
        </div>
        </form>


        </div>
        <!-- Content -->
      </section>
      <!--Section: Jumbotron-->
        </main>
        <!-- banner part start-->

  <?php include 'inc/footer.php'; ?>

<?php include 'inc/scripts.php'; ?>
</body>

</html>