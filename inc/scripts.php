  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>

  <script src="plugins/toastr/toastr.min.js"></script>

  <script type="text/javascript">
    $(function() {  
      <?php
       if(isset($_SESSION['success'])){
        echo "toastr.success('".$_SESSION['success']." ')";
          unset($_SESSION['success']);
        }

      ?>  
    });

  </script>
  <?php
    if(isset($_SESSION['error'])){
      foreach($_SESSION['error'] as $error) {
        echo "<script type='text/javascript'>
                $(function() { 
               toastr.error('".$error."');});</script>";
        }
      unset($_SESSION['error']);
    }
  ?> 