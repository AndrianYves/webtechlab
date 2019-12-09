<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>

<?php

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
            <h1 class="m-0 text-dark">Members</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Members</li>
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
                <div class="row">
                  Newly Register
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">ID Number</th>
                    <th width="120">Full Name</th>
                    <th width="200">Email</th>
                    <th width="100">Coure and Year</th>
                    <th width="100">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM users where status is NULL");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['idnumber'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course'];?> - <?php echo $row['year'];?></td>
                    <td>
                       <div class="btn-group btn-group-sm">
                        <a href='memberreject.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Reject</a>
                        <a href='memberjoin.php?id=<?php echo $row['id']; ?>' class="btn btn-success">Accept</i></a>
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
                <div class="row">
                  All Members
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">ID Number</th>
                    <th width="120">Full Name</th>
                    <th width="200">Email</th>
                    <th width="100">Coure and Year</th>
                    <th width="100">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM users where status is not NULL");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['idnumber'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course'];?> - <?php echo $row['year'];?></td>
                    <td><?php echo $row['status'];?></td>
                  </tr>
          
                  <?php   } ?>

                  </tbody>
                </table>
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
