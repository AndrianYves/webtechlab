<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
$link = "Accounts";
if(isset($_POST['submit'])){ 
  $error = false;
  if (empty($_POST['firstname'])) {
    $error = true;
    $_SESSION['error'][] = 'First is required.';
  } else {
    $firstname = test_input($_POST['firstname']);
  }

    if (empty($_POST['lastname'])) {
    $error = true;
    $_SESSION['error'][] = 'Lastname is required.';
  } else {
    $lastname = test_input($_POST['lastname']);
  }

    if (empty($_POST['username'])) {
    $error = true;
    $_SESSION['error'][] = 'Username is required.';
  } else {
    $username = test_input($_POST['username']);
  }

    $sql1 = mysqli_query($db, "SELECT * FROM accounts where email = '".$_POST['email']."' ");

    if (empty($_POST['email'])) {
      $error = true;
      $_SESSION['error'][] = 'Email is required.';
    } else if (mysqli_num_rows($sql1) > 0) {
      $error = true;
      $_SESSION['error'][] = 'Email already exist.'; 
    } else {
      $email = test_input($_POST['email']);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $_SESSION['error'][] = 'Invalid email format.'; 
      }
    }

    if (empty($_POST['password'])) {
    $error = true;
    $_SESSION['error'][] = 'Password is required.';
  } else {
    $password = $_POST['password'];
  }

  $role = $_POST["role"];

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO accounts(firstname, lastname, username, email, password, role, status) VALUES('$firstname', '$lastname', '$username', '$email', '$hashedPassword', '$role', 'Enabled')";   

  if(!$error){
    mysqli_query($db, $sql);
    $_SESSION['success'] = 'Account Created';
  }

}

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }


?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'inc/navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php if ($user['role'] == 'super'): ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Accounts</li>
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
                        <a href='allmemberreject.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Reject</a>
                        <a href='allmemberjoin.php?id=<?php echo $row['id']; ?>' class="btn btn-success">Accept</i></a>
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
                        <a href='allmemberreject.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Reject</a>
                        <a href='allmemberjoin.php?id=<?php echo $row['id']; ?>' class="btn btn-success">Accept</i></a>
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
                        <a href='allmemberreject.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Reject</a>
                        <a href='allmemberjoin.php?id=<?php echo $row['id']; ?>' class="btn btn-success">Accept</i></a>
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
                    <th width="50">Username</th>
                    <th width="120">Full Name</th>
                    <th width="200">Email</th>
                    <th width="100">Role</th>
                    <th width="100">Status</th>
                    <th width="100">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM accounts");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['lastname'];?>, <?php echo $row['firstname'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['role'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td>
                       <div class="btn-group btn-group-sm">
                        <a href='alladmindisabled.php?username=<?php echo $row['username']; ?>' class="btn btn-danger">Disable</a>
                        <a href='alladminenabled.php?username=<?php echo $row['username']; ?>' class="btn btn-info">Enable</a>
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
               Admins
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="allaccounts.php" method="post" >
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Firstname</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="First Name" name="firstname" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Lastname</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Last Name" name="lastname" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="role">
                          <option value="super">Super Admin</option>
                          <option value="admin">Admin</option>
                      </select>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Create Admin</button>
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

  <!-- Main Footer -->
  <?php include 'inc/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include 'inc/scripts.php'; ?>

</body>
</html>
