<?php include 'inc/header.php'; ?>
<body>
    <div class="body_bg">
      <?php include 'inc/navbar.php'; ?>
        <!-- banner part start-->
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-md-8">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                            <?php
                            $sql = mysqli_query($db, "SELECT * FROM maincontent");
                            $content = mysqli_fetch_assoc($sql);
                            ?>
                                <h1><?php echo $content['title'];?></h1>
                                <p><?php echo $content['content'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner part start-->
  <?php include 'inc/footer.php'; ?>
    </div>


<?php include 'inc/scripts.php'; ?>
</body>

</html>