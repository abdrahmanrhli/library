<?php
    $activePage = basename($_SERVER['PHP_SELF'], '.php');
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../home.php">
        <img src="../assets/images/logo/book1.png" alt="Logo" style="width: 60px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo ($activePage == 'home') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="../home.php">
                    <i class="ri-home-4-line"></i> Home <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item <?php echo ($activePage == 'books') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="../books.php">
                    <i class="ri-book-2-line"></i> Books
                </a>
            </li>
            <li class="nav-item <?php echo ($activePage == 'top-books') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="../top-books.php">
                    <i class="ri-fire-line"></i> Top Books
                </a>
            </li>
            <li class="nav-item <?php echo ($activePage == 'contact') ? 'active' : ''; ?>">
                <a class="nav-link text-orange" href="../contact.php">
                    <i class="ri-contacts-book-2-line"></i> Contact
                </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST" action="">
            <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
            <button onclick="SearchCatg();" class="btn btn-outline-success my-2 my-sm-0 search-btn" type="button">
                <i class="ri-search-line"></i>
            </button>
        </form>
        <?php if (isset($suserid)) { ?>
            <button  onclick="favoritesCatg();" class="btn btn-outline-success my-2 my-sm-0 favorite-btn" type="button">
                <i class="ri-heart-fill"></i>
            </button>
            <div class="dropdown">
                <img class="user-img dropdown-toggle" src="../assets/images/avatars/<?php if (!empty($savatar)) { echo $savatar; } else { echo 'avatar.png'; } ?>" alt="User" data-toggle="dropdown">
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../profile.php">
                        <i class="ri-profile-line"></i> Profile
                    </a>
                    <a class="dropdown-item" href="../logout.php">
                        <i class="ri-logout-box-r-line"></i> Logout
                    </a>
                </div>
            </div>
        <?php } else { ?>
            <button onclick="registerCatg();" class="btn btn-outline-success my-2 my-sm-0 favorite-btn" type="button">
                <i class="ri-user-add-line"></i> Sign up
            </button>
        <?php } ?>
    </div>
</nav>