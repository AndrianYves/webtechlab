<?php include 'inc/header.php'; 
$link = "Announcements";
?>
<body>
      <?php include 'inc/navbar.php'; ?>

 <main class="mt-5 pt-5">
    <div class="container">


      <!--Section: Cards-->
      <section class="pt-5">

               <?php
                  $sql = mysqli_query($db, "SELECT * FROM post where status = 'Active'");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
        <div class="row wow fadeIn" style="visibility: visible; animation-name: fadeIn;">

          <!--Grid column-->
          <div class="col-lg-5 col-xl-4 mb-4">
            <!--Featured image-->
            <div class="view overlay rounded z-depth-1">
              <img src="admins/image/<?php echo $row['image'];?>" class="img-fluid" alt="">
                <div class="mask rgba-white-slight waves-effect waves-light"></div>
              </a>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
            <h3 class="mb-3 font-weight-bold dark-grey-text">
              <strong><?php echo $row['title'];?></strong>
            </h3>
            <p class="grey-text"><?php echo $row['content'];?></p>
            <p>
              <strong><?php echo $row['date'];?></strong>
            </p>
            </a>
          </div>
          <!--Grid column-->

        </div>
        <hr class="mb-5">
                       <?php   } ?>
      </section>
      <!--Section: Cards-->

    </div>
  </main>
  <!--Main layout-->
  <?php include 'inc/footer.php'; ?>



<?php include 'inc/scripts.php'; ?>
</body>

</html>
