<?php 
  include 'inc/session.php';
  include 'inc/header.php';
 ?>
<?php
$link = "Activities";
 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

  if(isset($_POST['submit2'])){ 
    $act = $_POST['act'];
    $userid = $_POST['user'];
    $sql = mysqli_query($db,"UPDATE activityinvitation SET status = 'Accepted' WHERE activityID = '$act' and userID = '$userid'");

    $_SESSION['success'] = 'Activity request join Accepted';
  }

  if(isset($_POST['submit1'])){ 
    $act = $_POST['act'];
    $userid = $_POST['user'];

    $sql = mysqli_query($db,"UPDATE activityinvitation SET status = 'Rejected' WHERE activityID = '$act' and userID = '$userid'");

   $_SESSION['success'] = 'Activity request join Rejected';
  }

if(isset($_POST['submit'])){ 
  $error = false;

  if (empty($_POST['eventtitle'])) {
    $error = true;
    $_SESSION['error'][] = 'Event Title is required.';
  } else {
    $eventtitle = test_input($_POST['eventtitle']);
  }

  if (empty($_POST['description'])) {
    $error = true;
    $_SESSION['error'][] = 'Description is required.';
  } else {
    $description = test_input($_POST['description']);
  }

  $deadline = $_POST["deadline"];

  $sql = "INSERT INTO activities(title, description, deadline, status) VALUES('$eventtitle', '$description', '$deadline', 'Active')";   
  mysqli_query($db, $sql);

  $result1 = mysqli_query($db, "SELECT max(id) as lasID from activities");
  $query = mysqli_fetch_assoc($result1);
  $actID = $query['lasID'];

    $sql1 = mysqli_query($db, "SELECT * from users where status = 'Accepted'");
    while ($rows = mysqli_fetch_array($sql1)) { 
      $sql2 = "INSERT INTO activityinvitation(activityID, userID) VALUES('$actID', '".$rows['id']."')";   
      mysqli_query($db, $sql2);
    }


  if(!$error){
    
    $_SESSION['success'] = 'Poll Created';
  }

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
            <h1 class="m-0 text-dark">Activities</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Activities</li>
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
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">All</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
               <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">Event Title</th>
                    <th width="50">ID Number</th>
                    <th width="50">Full Name</th>
                    <th width="50">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT *, users.id as userID, activities.id as actID FROM activities join activityinvitation on activities.id = activityinvitation.activityID join users on activityinvitation.userID = users.id where choice = 'Joining' and activityinvitation.status is NULL");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['idnumber'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td>
                       <div class="btn-group btn-group-sm">
                        <form method="POST" action="activities.php">
                          <input class="form-check-input" type="hidden" name="user" value="<?php echo $row['userID'];?>">
                          <input class="form-check-input" type="hidden" name="act" value="<?php echo $row['actID'];?>">
                          <button class="btn btn-danger" name="submit1" type="submit">Reject</button>
                        </form>
                        <form method="POST" action="activities.php">
                          <input class="form-check-input" type="hidden" name="user" value="<?php echo $row['userID'];?>">
                          <input class="form-check-input" type="hidden" name="act" value="<?php echo $row['actID'];?>">
                          <button class="btn btn-success" name="submit2" type="submit">Accept</button>
                        </form>
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
                    <th width="50">Event Title</th>
                    <th width="50">Description</th>
                    <th width="50">Status</th>
                    <th width="50">Deadline of joining</th>
                    <th width="50">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT *, id as actID FROM Activities");
                  while ($row1 = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row1['title'];?></td>
                    <td><?php echo $row1['description'];?></td>
                    <td><?php echo $row1['status'];?></td>
                    <td><?php echo $row1['deadline'];?></td>
                    <td>
                     <div class="btn-group btn-group-sm">
                      <a href='eventreject.php?id=<?php echo $row1['actID']; ?>' class="btn btn-danger">Deactivate</a>
                      <a data-toggle="modal" data-target='#view<?php echo $row1['actID']; ?>' class="btn btn-info btn-sm m-0">View total</a>
                     </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="view<?php echo $row1['actID']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                       <dl>
                                <?php

                                  $sql1 = mysqli_query($db, "SELECT count(*) as joining FROM activityinvitation where activityID = '".$row1['actID']."' and choice = 'Joining'");
                                  $row2 = mysqli_fetch_assoc($sql1); 

                                  $sql2 = mysqli_query($db, "SELECT count(*) as notJoin FROM activityinvitation where activityID = '".$row1['actID']."' and choice = 'Not Joining'");
                                  $row3 = mysqli_fetch_assoc($sql2); 

                                  $sql3 = mysqli_query($db, "SELECT count(*) as cancelled FROM activityinvitation where activityID = '".$row1['actID']."' and choice = 'Cancelled'");
                                  $row4 = mysqli_fetch_assoc($sql3); 

                                  $sql4= mysqli_query($db, "SELECT count(*) as none FROM activityinvitation where activityID = '".$row1['actID']."' and choice is NULL");
                                  $row5 = mysqli_fetch_assoc($sql4); 
                                  ?>
                                <dt>Joining - <?php echo $row2['joining'];?></dt>
                                <dt>Not Joining - <?php echo $row3['notJoin'];?></dt>
                                <dt>Cancelled - <?php echo $row4['cancelled'];?></dt>
                                <dt>No Answer - <?php echo $row5['none'];?></dt>
                              </dl>

                            </div>
                            <!-- /.card-body -->
                          
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
          
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


         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
               Create Poll
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="activities.php" method="post" >
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Event Title</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Event Title" name="eventtitle" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" placeholder="Description" name="description" required></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Deadline of Joining</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" placeholder="Deadline" name="deadline" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Create Poll</button>
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


               