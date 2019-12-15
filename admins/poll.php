<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
$link = "Polls";
if(isset($_POST['submit'])){ 
  $question = $_POST["question"];

  $sql = "INSERT INTO pollquestion(question, status) VALUES('$question', 'Active')";   
  mysqli_query($db, $sql);
  echo "<script>alert('Question Created!);</script>";
}

if(isset($_POST['addchoice'])){ 
  $question = $_POST["question"];
  $choice = $_POST["choice"];

  $sql = "INSERT INTO pollchoices(choice, questionID) VALUES('$choice', '$question')";   
  mysqli_query($db, $sql);
  echo mysqli_error($db);
  echo "<script>alert('Question Created!);</script>";
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
            <h1 class="m-0 text-dark">Polls</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Polls</li>
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
               Poll
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped display">
                  <thead>
                  <tr>
                    <th width="50">Question</th>
                    <th width="50">Acion</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM pollquestion");
                  while ($row = mysqli_fetch_array($sql)) {
                        ?>
                  <tr>
                    <td><?php echo $row['question'];?></td>
                    <td>
                     <div class="btn-group btn-group-sm">
                      <a href='questiondelete.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Delete</a>
                      <a data-toggle="modal" data-target='#view<?php echo $row['id']; ?>' class="btn btn-info btn-sm m-0">View Choices and Total Votes</a>
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


                              <dl>
                                <?php
                                  $sql1 = mysqli_query($db, "SELECT * FROM pollchoices where questionID = '".$row['id']."'");
                                  while ($rows = mysqli_fetch_array($sql1)) { 

                                  $sql3 = mysqli_query($db, "SELECT count(pollanswers.userID) as total from pollchoices join pollanswers on pollchoices.id = pollanswers.choiceID where pollanswers.questionID = '".$row['id']."' and pollanswers.choiceID =  '".$rows['id']."' ");
                                  while ($row1 = mysqli_fetch_array($sql3)) {


                                    ?>
                                <dt><?php echo $rows['choice'];?> - <?php echo $row1['total'];?></dt>
                                  <?php  } } ?>
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
               <form class="form-horizontal" action="poll.php" method="post" >
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Question</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Question" name="question" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Create Poll</button>
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
               Add Choices
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <form class="form-horizontal" action="poll.php" method="post" >
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Choose Questions</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="question">
                        <?php $question = mysqli_query($db, "SELECT * from pollquestion");?>
                        <?php foreach($question as $que): ?>
                          <option value="<?= $que['id']; ?>"><?= ucfirst($que['question']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Choices</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="choice">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary" name="addchoice">Add Choices</button>
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
