<?php
    $activePage = basename($_SERVER['PHP_SELF'], '.php');
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home.php">
        <img src="assets/images/logo/book1.png" alt="Logo" style="width: 60px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="dashboard.php">
                    <i class="ri-dashboard-line"></i> Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item <?php echo ($activePage == 'manage-covers') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="manage-covers.php">
                    <i class="ri-image-line"></i> Covers
                </a>
            </li>
            <li class="nav-item <?php echo ($activePage == 'manage-books') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="manage-books.php">
                    <i class="ri-book-2-line"></i> Books
                </a>
            </li>
            <li class="nav-item <?php echo ($activePage == 'manage-users') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="manage-users.php">
                    <i class="ri-user-2-line"></i> Users
                </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST" action="">
            <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
            <button onclick="Search();" class="btn btn-outline-success my-2 my-sm-0 search-btn" type="button">
                <i class="ri-search-line"></i>
            </button>
        </form>
        <?php if (isset($suserid)) { ?>
            <button  onclick="inbox();" class="btn btn-outline-success my-2 my-sm-0 favorite-btn" type="button">
                <i class="ri-mail-fill"></i>
            </button>
            <div class="dropdown">
                <img class="user-img dropdown-toggle" src="assets/images/avatars/<?php if (!empty($savatar)) { echo $savatar; } else { echo 'avatar.png'; } ?>" alt="User" data-toggle="dropdown">
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php">
                        <i class="ri-profile-line"></i> Profile
                    </a>
                    <a class="dropdown-item" href="logout.php">
                        <i class="ri-logout-box-r-line"></i> Logout
                    </a>
                </div>
            </div>
        <?php } else { ?>
            <button onclick="register();" class="btn btn-outline-success my-2 my-sm-0 favorite-btn" type="button">
                <i class="ri-user-add-line"></i> Sign up
            </button>
        <?php } ?>
    </div>
</nav>