<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
$link = "Information";
if(isset($_POST['main'])){ 
  $title = $_POST["title"];
  $content = $_POST["content"];
  $id = $_POST["id"];

  $sql = "UPDATE maincontent SET title = '$title', content = '$content' WHERE id='$id'"; 
  mysqli_query($db, $sql);

  $_SESSION['success'] = 'Main Content Updated';

}

if(isset($_POST['visionmission'])){ 
  $vision = $_POST["vision"];
  $mission = $_POST["mission"];

  $sql = "UPDATE visionmission SET vision = '$vision', mission = '$mission'"; 
  mysqli_query($db, $sql);

  $_SESSION['success'] = 'Vision/Mission Updated';

}

if(isset($_POST['updateaboutus'])){ 
  $abouttitle = $_POST["abouttitle"];
  $aboutcontent = $_POST["aboutcontent"];
  $id = $_POST["aboutid"];
  $timestamp = date("Y-m-d H:i:s");

  $sql = "UPDATE aboutus SET title = '$abouttitle', content = '$aboutcontent', timestamp = '$timestamp' where id = '$id'"; 
  mysqli_query($db, $sql);

  $_SESSION['success'] = 'New Content Added';

}

if(isset($_POST['newaboutus'])){ 
  $newtitle = $_POST["newtitle"];
  $newcontent = $_POST["newcontent"];
  $timestamp = date("Y-m-d H:i:s");

  $sql = "INSERT INTO aboutus(title, content, timestamp) VALUES('$newtitle', '$newcontent', '$timestamp')";   
  mysqli_query($db, $sql);

  $_SESSION['success'] = 'New Content Added';

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
            <h1 class="m-0 text-dark">Main Page Content</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Main Page Content</li>
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
                  <button type="submit" class="btn btn-primary" name="main">Update</button>
                  </form>
              </div>
              <!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
               Vision and Mission
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="page.php" method="post" >
                <?php
                  $sql1 = mysqli_query($db, "SELECT * FROM visionmission");
                  $visionmission = mysqli_fetch_assoc($sql1);
                ?>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Vision</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="<?php echo $visionmission['vision'];?>" name="vision" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Mission</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="<?php echo $visionmission['mission'];?>" name="mission" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="visionmission">Update</button>
                  </form>
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
                  About Us
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                  <tr>
                    <th width="50">Title</th>
                    <th width="120">Content</th>
                    <th width="200">Last Updated</th>
                    <th width="200">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM aboutus");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['content'];?></td>
                    <td><?php echo $row['timestamp'];?></td>
                    <td>
                       <div class="btn-group btn-group-sm">
                        <a href='aboutusdelete.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Delete</i></a>
                        <a data-toggle="modal" data-target='#view<?php echo $row['id']; ?>' class="btn btn-info">Update</a>
                     </div>
                    </td>
                  </tr>

                  <div class="modal fade" id="view<?php echo $row['id']; ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                            <form class="form-horizontal" action="page.php" method="post" >
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                  <input type="hidden" class="form-control" value="<?php echo $row['id'];?>" name="aboutid" required>
                                  <input type="text" class="form-control" value="<?php echo $row['title'];?>" name="abouttitle" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" value="<?php echo $row['content'];?>" name="aboutcontent" required>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-body -->
                          
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="updateaboutus">Update</button>
                          </form>
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
                <br>
                <button class="btn btn-primary" data-toggle="modal" data-target='#newaboutus'>Add New Content</button>
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

    <div class="modal fade" id="newaboutus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
           <form class="form-horizontal" action="page.php" method="post" >
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="newtitle" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="newcontent" required>
                </div>
              </div>
          </div><!-- /.card-body -->
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="newaboutus">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Main Footer -->
  <?php include 'inc/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php include 'inc/scripts.php'; ?>

</body>
</html>
