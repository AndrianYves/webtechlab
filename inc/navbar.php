<?php if(empty($_SESSION['users'])): ?>


    <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a href="index.php" class="navbar-brand waves-effect">
          <strong class="blue-text">OrgIT </strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link waves-effect" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">

            <li class="nav-item">
              <a class="nav-link waves-effect" data-toggle="modal" data-target="#signup">Signup
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link waves-effect" data-toggle="modal" data-target="#login">Login
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->

  </header>
  <!--Main Navigation-->

 
  <?php else: ?>


     <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a href="index.php" class="navbar-brand waves-effect">
          <strong class="blue-text">OrgIT </strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($link == 'Home') {echo 'active';} ?>">
              <a class="nav-link waves-effect" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item <?php if($link == 'Announcements') {echo 'active';} ?>">
              <a class="nav-link waves-effect" href="announcements.php">Announcements<?php
                $sql1 = mysqli_query($db, " SELECT count(*) as counted from post where DATEDIFF('".$today."', date) < '3';  ");
                 $row2 = mysqli_fetch_assoc($sql1);
                 $count = $row2['counted'];
                 if ($count > '0'){
                  echo '<span class="badge red z-depth-1 mr-1">'.$count.'</span>';
                 }
                ?> </a>
              
            </li>
            <li class="nav-item <?php if($link == 'Poll') {echo 'active';} ?>">
              <a class="nav-link waves-effect" href="poll.php">Poll
                <?php
                $sql = mysqli_query($db, " SELECT count(*) as counted from pollquestion left join pollanswers on pollquestion.id = pollanswers.questionID where pollanswers.userID = '".$user['id']."' and pollanswers.choiceID is NULL and pollquestion.endofdate > '".$today."'");
                 $row1 = mysqli_fetch_assoc($sql);
                 $counted = $row1['counted'];
                 if ($counted > '0'){
                  echo '<span class="badge red z-depth-1 mr-1">'.$counted.'</span>';
                 }
                ?>  
              </a>
            </li>
          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item <?php if($link == 'Profile') {echo 'active';} ?>">
              <a href="viewprofile.php" class="nav-link waves-effect"><?php echo ucwords($user['firstname']). ' '.ucwords($user['lastname']); ?></a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link waves-effect">Logout
              </a>
            </li>
          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->



  </header>
  <!--Main Navigation-->
  <?php endif ?>