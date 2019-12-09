<?php include 'inc/header.php'; ?>
<body>
      <?php include 'inc/navbar.php'; ?>
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Announcements</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->
 
 <div class="element_page black">
        <!-- Start Sample Area -->
                          <?php
                  $sql = mysqli_query($db, "SELECT * FROM post where status = 'Active'");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                        <div class="section-top-border">
                            <h3 class="mb-30"><?php echo $row['title'];?></h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="single-defination">
                                        <h4 class="mb-20"><?php echo $row['content'];?></h4>
                                        <p><?php echo $row['date'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php   } ?>
                

            </div>
                  
  <?php include 'inc/footer.php'; ?>



<?php include 'inc/scripts.php'; ?>
</body>

</html>