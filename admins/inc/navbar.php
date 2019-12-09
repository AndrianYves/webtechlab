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
    <!-- Sidebar -->
    <div class="sidebar">

<?php if($user['role'] == 'super'): ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Page Information
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="members.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Members
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="announcements.php" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="poll.php" class="nav-link">
              <i class="nav-icon fas fa-poll"></i>
              <p>
                Polls
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="users.php" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Users
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
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page.php" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Page Information
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="members.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Members
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="announcements.php" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="poll.php" class="nav-link">
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