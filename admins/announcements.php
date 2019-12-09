<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
if(isset($_POST['submit'])){ 
  $title = $_POST["title"];
  $content = $_POST["content"];
  $date = $_POST["date"];

  $sql = "INSERT INTO post(title, content, date, status) VALUES('$title', '$content', '$date', 'Active')";   
    mysqli_query($db, $sql);
  echo "<script>alert('Post Created!);</script>";
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
            <h1 class="m-0 text-dark">Announcements</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Announcements</li>
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
               Admins
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">Title</th>
                    <th width="120">Content</th>
                    <th width="200">Date</th>
                    <th width="100">Status</th>
                    <th width="100">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM post");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['content'];?></td>
                    <td><?php echo $row['date'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td>
                       <div class="btn-group btn-group-sm">
                        <a href='announcementinactive.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Deactive</a>
                        <a href='announcementactive.php?id=<?php echo $row['id']; ?>' class="btn btn-info">Activate</a>
                      </div>
                    </td>
                  </tr>
          
                  <?php   } ?>


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->

         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
               Announce
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="announcements.php" method="post" >
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Title" name="title" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Content" name="content" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="date" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Create Post</button>
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
