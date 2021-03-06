<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="nav-icon fas fa-sign-out-alt"></i> Sign-out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-gray elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">OrgIT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $user['firstname']. ' '.$user['lastname']; ?></a>
        </div>
      </div>
<?php if($user['role'] == 'super'): ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($link == 'Dashboard') {echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page.php" class="nav-link <?php if($link == 'Information') {echo 'active';} ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Page Information
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="allaccounts.php" class="nav-link <?php if($link == 'Accounts') {echo 'active';} ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                All Accounts
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="activities.php" class="nav-link <?php if($link == 'Activities') {echo 'active';} ?>">
              <i class="nav-icon fas fa-calendar-plus"></i>
              <p>
                Activities
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="announcements.php" class="nav-link <?php if($link == 'Announcements') {echo 'active';} ?>">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="poll.php" class="nav-link <?php if($link == 'Polls') {echo 'active';} ?>">
              <i class="nav-icon fas fa-poll"></i>
              <p>
                Polls
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="semester.php" class="nav-link <?php if($link == 'Semester') {echo 'active';} ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
  <?php else: ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="members" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($link == 'Dashboard') {echo 'active';} ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page.php" class="nav-link <?php if($link == 'Information') {echo 'active';} ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Page Information
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="members.php" class="nav-link <?php if($link == 'Members') {echo 'active';} ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Members
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="activities.php" class="nav-link <?php if($link == 'Activities') {echo 'active';} ?>">
              <i class="nav-icon fas fa-calendar-plus"></i>
              <p>
                Activities
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="announcements.php" class="nav-link <?php if($link == 'Announcements') {echo 'active';} ?>">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="poll.php" class="nav-link <?php if($link == 'Polls') {echo 'active';} ?>">
              <i class="nav-icon fas fa-poll"></i>
              <p>
                Polls
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
  <?php endif ?>
    </div>
    <!-- /.sidebar -->
  </aside>