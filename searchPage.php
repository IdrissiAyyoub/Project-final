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
    <link rel="stylesheet" href="./css/searchPage.css">
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
                        <a href="IndexPage.php" class="nav__link active-link">
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
    <section>
        <div class="header-main mobile-hide">
            <div class="container">
                <div class="wrapper flexitem">
                    <div class="left">
                        <div class="dpt-cat">

                        </div>
                    </div>
                    <div class="right">
                        <div class="search-box">
                            <form action="" class="search">
                                <span class="icon-large"><i class="ri-search-line"></i></span>
                                <input type="search" name="search" id="search" placeholder="Search for products">
                                <button type="submit">Search</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="content">
            <aside class="filters">
                <section>
                    <h2>Category</h2>
                    <label><input type="checkbox"> Action (19)</label>
                    <label><input type="checkbox"> Fiction (7)</label>
                    <label><input type="checkbox"> Romance (8)</label>
                    <label><input type="checkbox"> Fantasy (14)</label>
                </section>

                <section>
                    <h2>Authors</h2>
                    <label><input type="checkbox"> J.K. Rowling</label>
                    <label><input type="checkbox"> Stephen King</label>
                    <label><input type="checkbox"> Jane Austen</label>
                    <label><input type="checkbox"> Harper Lee</label>
                </section>

                <section>
                    <h2>Language</h2>
                    <label><input type="checkbox"> English</label>
                    <label><input type="checkbox"> Spanish</label>
                    <label><input type="checkbox"> French</label>
                    <label><input type="checkbox"> German</label>
                </section>
            </aside>
            <div class="popular__container container">
                <div class="popular__grid">
                    <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a> <a href="" class="popular__card swiper-slide">
                        <img src="./Images/9780593570616.jpg" alt="image" class="popular__img">

                        <div>
                            <h2 class="popular__tiitle">Popular Books</h2>
                            <div class="popular__prices">
                                <span class="popular__author">
                                    Jomas bla
                                </span>
                            </div>
                            <div class="popular__stars">
                                5 <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <button class="PopularButton">Detailes</button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


        </div>

    </section>





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