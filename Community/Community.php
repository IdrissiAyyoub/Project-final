<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="./css/Cummunity.css">

    <title>Socila Books Community</title>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>




        </div>
        <div class="navbar-center">
            <ul>
                <li><a href=""><span>Home</span></a></li>
                <li><a href="" class="active-link"><span>Community</span></a></li>
                <li><a href=""><span>My follow</span></a></li>
            </ul>
        </div>
        <div class="navbar-right">

            <img src="./images/user-1.png" class="nav-profile-img ">
        </div>

    </nav>


    <!-- -------------------- navbar close -------------------- -->

    <div class="container">
        <!-- --------------------left sidebar ----------------- -->
        <div class="left-sidebar">
            <div class="sidebar-profile-box">
                <img src="./images/cover-pic.png" width="100%">
                <div class="sidebar-profile-info">
                    <img src="./images/user-1.png">
                    <h1>Ayyoub Idrissi</h1>
                    <h3>@ayyoub</h3>
                    <ul>
                        <li>Books Shared <span>50</span></li>
                        <li>Books Upload <span>50</span></li>
                        <li>Books Read <span>50</span></li>

                    </ul>
                </div>
                <div class="sidebar-profile-link">
                    <a href="#"><i class="ri-save-line"></i> My Books</a>
                    <a href="#"><i class="ri-upload-cloud-2-line"></i> Upload</a>

                </div>
            </div>

        </div>
        <!-- ------------------------main-content------------------------------ -->
        <div class="main-content">
            <div class="create-post">
                <div class="create-post-input">
                    <img src="./images/user-1.png" alt="">
                    <textarea placeholder="Write a post"></textarea>
                </div>
                <div class="post-button">
                    <button>Post</button>
                </div>
            </div>

            <div class="sort-by">
                <hr>
                <p>Sort by: <span>top <i class="ri-arrow-down-s-line"></i></span></p>
            </div>

            <div class="post">
                <div class="post-author">
                    <img src="./images/user-3.png" alt="">
                </div>
            </div>
        </div>

        <!-- ----------------------right-sidebar----------------------------------- -->
        <div class="right-sidebar">
            <div class="search-container">
                <h3>Search</h3>
                <div class="search-box">
                    <input type="text" placeholder="Search for someone">
                    <i class="ri-search-line"></i>
                </div>
                <div class="search-result">
                    <div class="search-result-item">
                        <img src="./images/user-1.png" alt="Profile Image">
                        <div>
                            <h4>Ayyoub</h4>
                            <p>@ayyoub</p>
                        </div>
                        <button class="follow-btn">Follow</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>