<?php include 'inc/session.php'; ?>
<?php if(isset($_SESSION['users'])): ?>

<header class="main_menu single_page_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.html"> <img src="img/logo.png" alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="announcements.php">Announcements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="poll.php">Poll</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="myaccount.php"><?php echo $user['firstname']. ' '.$user['lastname']; ?></a>
                            </li>
                        </ul>
                    </div>
                    <a href="logout.php" class="btn_1 d-none d-sm-block">Logout</a>
                </nav>
            </div>
        </div>
    </div>
</header>
  <?php else: ?>

<header class="main_menu single_page_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Sign-up</a>
                            </li>
                        </ul>
                    </div>
                    <a href="login.php" class="btn_1 d-none d-sm-block">Login</a>
                </nav>
            </div>
        </div>
    </div>
</header>
  <?php endif ?>