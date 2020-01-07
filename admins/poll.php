<?php 
  include 'inc/session.php';
  include 'inc/header.php';
  include 'inc/db.php';
 ?>
<?php
$link = "Polls";
if(isset($_POST['submit'])){ 
  $question = $_POST["question"];
  $date = $_POST["date"];

  $sql = "INSERT INTO pollquestion(question, endofdate, status) VALUES('$question', '$date', 'Active')";   
  mysqli_query($db, $sql);

  $result1 = mysqli_query($db, "SELECT max(id) as lasID from pollquestion");
  $query = mysqli_fetch_assoc($result1);
  $quesNumber = $query['lasID'];

  $sql1 = mysqli_query($db, "SELECT * from users where status = 'Accepted'");
  while ($rows = mysqli_fetch_array($sql1)) { 
    $sql = "INSERT INTO pollanswers(questionID, userID) VALUES('$quesNumber', '".$rows['id']."')";   
    mysqli_query($db, $sql);
  }

  $number = count($_POST["choice"]);
  for($i=0; $i<$number; $i++) {
    $sql = "INSERT INTO pollchoices(choice, questionID) VALUES('".$_POST["choice"][$i]."', '$quesNumber')";
    mysqli_query($db, $sql);
  }

  $_SESSION['success'] = 'Poll Created';
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
                    <th width="50">End Date</th>
                    <th width="50">Status</th>
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
                    <td><?php echo $row['endofdate'];?></td>
                    <td><?php echo $row['status'];?></td>
                    <td>
                     <div class="btn-group btn-group-sm">
                      <a href='questiondelete.php?id=<?php echo $row['id']; ?>' class="btn btn-danger">Deactivate</a>
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
                  <div class="form-group">
                    <label for="inputEmail3">Add Choices</label>
                  
                  <table id="dynamic_field" class="table table-condensed">
                  <tbody>
                  <tr>
                    <td>
                      <input type="text" class="form-control" name="choice[]" id="choice_1" required>
                    </td>
                    <td>
                    <button type="button" name="add" id="add" class="btn btn-success btn-xs">Add Choice</button>
                    </td>
                  </tr>

                  </tbody>
                </table>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">End of poll</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" name="date" required>
                    </div>
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

<script>
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;
    $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" class="form-control" name="choice[]" id="choice_'+i+'" required></td><td><a type="button" name="remove" id="'+i+'" class="btn_remove btn btn-danger btn-xs">DELETE</a></td></tr>');
  });
  

  $(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id"); 
    $('#row'+button_id+'').remove();
  });
  
});

</script>

</body>
</html>
