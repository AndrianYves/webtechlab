<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
$link = "Semester";
if(isset($_POST['submit'])){ 
  $datestart = $_POST["datestart"];
  $dateend = $_POST["dateend"];

  $sql = "UPDATE semesterdate SET semesterStart = '$datestart', semesterend = '$dateend'"; 
  mysqli_query($db, $sql);
  $_SESSION['success'] = 'Semester Updates';
}
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'inc/navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <?php if ($user == 'super'): ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Semester</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Semester</li>
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
               Change Semester Date
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="semester.php" method="post" >
                <?php
                  $sql = mysqli_query($db, "SELECT * FROM semesterdate");
                  $date = mysqli_fetch_assoc($sql);
                ?>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Date Start</label>
                    <div class="col-sm-9">
                      <input type="hidden" class="form-control" value="<?php echo $date['id'];?>" name="id" required>
                      <input type="date" class="form-control" value="<?php echo $date['semesterstart'];?>" name="datestart" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Date End</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" value="<?php echo $date['semesterend'];?>" name="dateend" required>
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
    <?php else: ?>
    <?php include 'forbidden.php'; ?>
  <?php endif ?>

  <?php include 'inc/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include 'inc/scripts.php'; ?>

</body>
</html>
