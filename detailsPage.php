<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="./css/swiper-bundle.min.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="./css/detailsPage.css">

    <title>Document</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">
                            <i class="ri-home-line"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#books" class="nav__link">
                            <i class="ri-booklet-line"></i>
                            <span>Book's</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#community" class="nav__link">
                            <i class="ri-group-line"></i>
                            <span>Community</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nav__actions">
                <i class="ri-user-line login-button" id="login-button"></i>

                <i class="ri-moon-line change-theme" id="theme-button"></i>
            </div>
        </nav>
    </header>


    <!--==================== LOGIN ====================-->
    <div class="login grid" id="login-content">
        <form action="" class="login__from grid">
            <h3 class="login__title">Log In</h3>
            <div class="login__group grid">
                <div>
                    <label for="login-email" class="login__label">Email</label>
                    <input type="email" placeholder="Write your email" id="login-email" class="login__input">
                </div>

                <div>
                    <label for="login-pass" class="login__label">Password</label>
                    <input type="password" placeholder="Enter your password" id="login-pass" class="login__input">
                </div>
            </div>

            <div>
                <span class="login__signup">
                    You do not have an account? <a href="#">Sign up</a>
                </span>
                <button type="submit" class="login__button button">Log In</button>
            </div>
        </form>

        <i class="ri-close-line login__close" id="login-close"></i>
    </div>
    <div class="book-detail">
        <div class="backdrop-image" style="background-image: url(./Images/9780593570616.jpg);">

        </div>
        <figure class="poster-box book-poster">
            <img src="./Images/9780593570616.jpg" alt="" class="img-cover">
        </figure>

        <div class="detail-box">
            <div class="detail-content">
                <h1 class="heading">Atomic Habits</h1>
                <div class="meta-list">
                    <div class="meta-item">
                        <img src="./Images/9780593570616.jpg" alt="rating" width="20" height="20">
                        <span class="span">6</span>
                    </div>

                    <div class="separator"></div>
                    <div class="meta-item">88 pages</div>

                    <div class="separator"></div>

                    <div class="meta-item">2018</div>

                    <div class="meta-item card-badge">PG-05</div>


                </div>

                <p class="genre">Animation, Acttion, </p>
                <p class="overflow">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex eius rem omnis vitae quam saepe ipsam. Maxime commodi, nobis laborum quod aliquam iusto aperiam dicta doloribus! Fugit exercitationem provident aut!
                </p>
                <ul class="details-list">
                    <div class="list-item">
                        <p class="list-name">Starring</p>

                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi quisquam ab architecto qui facilis dolor perspiciatis, tempore nesciunt eaque fugit alias repellendus nostrum dolorum cumque, sed provident beatae culpa iusto.

                        </p>
                    </div>
                    <div class="list-item">
                        <p class="list-name">Direct by </p>

                        <p>
                            Louis macro
                        </p>
                    </div>
                </ul>
            </div>

            <div class="title-wrapper">
                <h3 class="title-large">More links</h3>
            </div>

            <div class="slider-list">
                <div class="slider-inner">
                    <div class="video-card"></div>
                </div>
            </div>
        </div>
    </div>


    <!--==================== FOOTER ====================-->
    <footer class="footer">
        <div class="footer__container container grid">
            <div>
                <a href="" class="footer__logo">
                    <i class="ri-book-3-line"></i> SocialBook's
                </a>
                <p class="footer__description">
                    Where Readers Connect and Share Their Literary Adventures.
                </p>
            </div>
            <div class="footer__data grid">
                <div>
                    <h3 class="footer__title">About</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="" class="footer__link">Awards</a>
                        </li>
                        <li>
                            <a href="" class="footer__link">FAQs</a>
                        </li>
                        <li>
                            <a href="" class="footer__link">Privacy pollice</a>
                        </li>
                        <li>
                            <a href="" class="footer__link">Terms of services</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Links</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="" class="footer__link">Home</a>
                        </li>
                        <li>
                            <a href="" class="footer__link">Community</a>
                        </li>
                        <li>
                            <a href="" class="footer__link">Search</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Contact</h3>

                    <ul class="footer__links">
                        <li>
                            <a href="" class="footer__link">Email</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <span class="footer__copy">
            &#169; All Rights Reserved By SocialBook's
        </span>
    </footer>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="./js/scrollreveal.min.js"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="./js/swiper-bundle.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="./js/main.js"></script>


</body>

</html>