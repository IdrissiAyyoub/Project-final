<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/upload.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class="ri-book-3-line"></i> <span class="logo_name">SocialBook's</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="Community.php">
                    <i class="ri-community-line"></i>
                    <span class="link_name">Community</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Community</a></li>
                </ul>
            </li>
            <li>
                <a href="profile.php">
                    <i class="ri-bookmark-line"></i>
                    <span class="link_name">Saved Books</span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="#">Saved Books</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="upload.php">
                    <i class="ri-upload-line"></i>
                    <span class="link_name">Upload a Book</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Upload a Book</a></li>
                </ul>
            </li>
            <li>
                <a href="userProfile.php">
                    <i class="ri-user-line"></i>
                    <span class="link_name">User Information</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">User Information</a></li>
                </ul>
            </li>
            <li>
                <a href="../logout.php">
                    <i class="ri-logout-circle-line"></i></i>
                    <span class="link_name">Log out</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Log out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <section class="container">
        <div class="logo">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> Community
            </a>
        </div>
        <header>Choose Action</header>
        <div class="button-group">
            <button class="button" onclick="location.href='save_books.php'">Save Book</button>
            <button class="button" onclick="location.href='share_books.php'">Share Book</button>
        </div>

    </section>
</body>

</html>