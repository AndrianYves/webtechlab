<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
$link = "Information";
if(isset($_POST['submit'])){ 
  $title = $_POST["title"];
  $content = $_POST["content"];
  $id = $_POST["id"];

  $sql = "UPDATE maincontent SET title = '$title', content = '$content' WHERE id='$id'"; 
  mysqli_query($db, $sql);
  echo "<script>alert('Page Content Updated!);</script>";
}
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'inc/navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Main Header</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Main Header</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

 <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
               Main Content
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="page.php" method="post" >
                <?php
                  $sql = mysqli_query($db, "SELECT * FROM maincontent");
                  $content = mysqli_fetch_assoc($sql);
                ?>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                      <input type="hidden" class="form-control" value="<?php echo $content['id'];?>" name="id" required>
                      <input type="text" class="form-control" value="<?php echo $content['title'];?>" name="title" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="<?php echo $content['content'];?>" name="content" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Update</button>
                  </form>
              </div>
              <!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->


      </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <?php include 'inc/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include 'inc/scripts.php'; ?>

</body>
</html>
