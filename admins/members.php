<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>

<?php
$link = "Members";
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
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header">
                <div class="row">
                  Members
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">New</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">All</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Rejected</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
              <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">ID Number</th>
                    <th width="120">Full Name</th>
                    <th width="200">Email</th>
                    <th width="100">Coure and Year</th>
                    <th width="100">Last Enrolled</th>
                    <th width="100">Status</th>
                    <th width="100">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM users where status is NULL || status = 'Renewing'");
                  while ($row = mysqli_fetch_array($sql)) {
                    if (empty($row['endofsem'])){
                      $sem = "Newly Register";
                    } else {
                      $sem = $row['endofsem'];
                    }
                        ?>
                  <tr>
                    <td><?php echo $row['idnumber'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course'];?> - <?php echo $row['year'];?></td>
                    <td><?php echo $sem;?></td>
                    <td><?php echo $row['status'];?></td>
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
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
   <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">ID Number</th>
                    <th width="120">Full Name</th>
                    <th width="200">Email</th>
                    <th width="100">Coure and Year</th>
                    <th width="100">Last Enrolled</th>
                    <th width="100">Status</th>
                    <th width="100">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM users where status = 'Accepted'");
                  while ($row = mysqli_fetch_array($sql)) {
                    if (empty($row['endofsem'])){
                      $sem = "Newly Register";
                    } else {
                      $sem = $row['endofsem'];
                    }
                        ?>
                  <tr>
                    <td><?php echo $row['idnumber'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course'];?> - <?php echo $row['year'];?></td>
                    <td><?php echo $sem;?></td>
                    <td><?php echo $row['status'];?></td>
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
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
   <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">ID Number</th>
                    <th width="120">Full Name</th>
                    <th width="200">Email</th>
                    <th width="100">Coure and Year</th>
                    <th width="100">Last Enrolled</th>
                    <th width="100">Status</th>
                    <th width="100">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM users where status = 'Rejected'");
                  while ($row = mysqli_fetch_array($sql)) {
                    if (empty($row['endofsem'])){
                      $sem = "Newly Register";
                    } else {
                      $sem = $row['endofsem'];
                    }
                        ?>
                  <tr>
                    <td><?php echo $row['idnumber'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['course'];?> - <?php echo $row['year'];?></td>
                    <td><?php echo $sem;?></td>
                    <td><?php echo $row['status'];?></td>
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
              </div>
              <!-- /.card -->
            </div>

             
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
