<?php include 'inc/header.php'; ?>
<body>
      <?php include 'inc/navbar.php'; ?>
      <!--Main layout-->
  <main class="mt-5 pt-5">
    <div class="container">

      <!--Section: Jumbotron-->
      <section class="card blue-gradient wow fadeIn" id="intro">

        <!-- Content -->
        <div class="card-body text-white text-center py-5 px-5 my-5">
            <?php
                            $sql = mysqli_query($db, "SELECT * FROM maincontent");
                            $content = mysqli_fetch_assoc($sql);
                            ?>
          <h1 class="mb-4">
            <strong><?php echo $content['title'];?></strong>
          </h1>
          <p class="mb-4">
            <strong><?php echo $content['content'];?>.</strong>
          </p>


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