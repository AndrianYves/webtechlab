<?php include 'inc/header.php'; ?>
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
        <!--Grid row-->
        <div class="row wow fadeIn">


          <!--Grid column-->
          <div class="col-lg-12 mb-4">
            <h3 class="mb-3 font-weight-bold dark-grey-text">
              <strong><?php echo $row['title'];?></strong>
            </h3>
            <p class="grey-text"><?php echo $row['content'];?></p>
            <p>
              <strong><?php echo $row['date'];?></strong>
            </p>
          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->
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
