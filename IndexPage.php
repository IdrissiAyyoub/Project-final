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
    <link rel="stylesheet" href="./css/styles.css">

    <title>Responsive book website</title>
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

    <!--==================== MAIN ====================-->
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home section" id="home">
            <div class="home__container container grid">
                <div class="home__data">
                    <h1 class="home__title">
                        Community & <br>
                        Browser E-Books
                    </h1>

                    <p class="home__description">Explore, share, and discover the wonderful world of books with our online community. Join us today!</p>

                    <a href="" class="button">Community</a>
                </div>

                <div class="home__images">
                    <div class="home__swiper swiper">
                        <div class="swiper-wrapper">
                            <article class="home__article swiper-slide">
                                <img src="./Images/9780735211292.jpg" alt="image" class="home__img">
                            </article>
                            <article class="home__article swiper-slide">
                                <img src="./Images/9781635577990.jpg" alt="image" class="home__img">
                            </article>
                            <article class="home__article swiper-slide">
                                <img src="./Images/Dune cover.webp" alt="image" class="home__img">
                            </article>
                            <article class="home__article swiper-slide">
                                <img src="./Images/715+riJ5sLL._AC_UF1000,1000_QL80_.jpg" alt="image" class="home__img">
                            </article>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!--==================== SERVICES ====================-->
        <section class="services section">
            <div class="services__container container grid">
                <article class="services__card">
                    <i class="ri-book-open-line"></i>
                    <h3 class="services__title">Iconics Book</h3>
                    <p class="services__description">Uncover Timeless Treasures.</p>
                </article>

                <article class="services__card">
                    <i class="ri-line-chart-line"></i>
                    <h3 class="services__title">Reading Stattus</h3>
                    <p class="services__description">Track, Share, and Explore Your Reading Journey.</p>
                </article>

                <article class="services__card">
                    <i class="ri-team-line"></i>
                    <h3 class="services__title">Community sharing</h3>
                    <p class="services__description">Connect, Discover, and Share Your Favorite Reads.</p>
                </article>
            </div>
        </section>

        <!--==================== FEATURED ====================-->
        <section class="featured section" id="books">
            <h2 class="section__title">Featured Books</h2>

            <div class="featured__container container">
                <div class="featured__swiper swiper">
                    <div class="swiper-wrapper">
                        <!-- JavaScript will populate this section with book data -->
                    </div>

                    <div class="swiper-button-prev">
                        <i class="ri-arrow-left-s-line"></i>
                    </div>
                    <div class="swiper-button-next">
                        <i class="ri-arrow-right-s-line"></i>
                    </div>
                </div>
            </div>
        </section>


        <!--==================== DISCOUNT ====================-->
        <section class="search section" id="search">
            <div class="search__container container grid">
                <div class="search__data">
                    <h2 class="search__title section__title">
                        Search by your Tast
                    </h2>

                    <p class="search__description">
                        Find Your Next Favorite Read with Personalized Recommendations.
                    </p>

                    <a href="searchPage.php" class="button">More here</a>
                </div>

                <div class="search__images">
                    <img src="./Images/1603897583-image17-1.jpg" alt="image" class="search__img-one">
                    <img src="./Images/1603897574-image30-1.jpg" alt="image" class="search__img-two">
                </div>
            </div>
        </section>

        <!--==================== popular BOOKS ====================-->
        <section class="popular section" id="popular">
            <h2 class="section__title">
                Popular Books
            </h2>

            <div class="popular__container container">
                <div class="popular__swiper swiper">
                    <div class="swiper-wrapper">
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
                <div class="popular__swiper swiper">
                    <div class="swiper-wrapper">
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

        <!--==================== JOIN ====================-->
        <section class="join section">
            <div class="join__container">
                <img src="./Images/1603897583-image17-1.jpg" alt="image" class="join__bg">

                <div class="join__data container grid">
                    <h2 class="join__title section__title">
                        Subscribe To Receive <br>
                        The Latest Updates
                    </h2>

                    <form action="" class="join__form">
                        <input type="email" placeholder="Enter email" class="join__input">
                        <button type="submit" class="join__button button">Subcribe</button>
                    </form>
                </div>
            </div>
        </section>

        <!--==================== TESTIMONIAL ====================-->
        <section class="testimonial section" id="testimonial">
            <h2 class="section__title">
                From Comminuty
            </h2>

            <div class="testimonial__container container">
                <div class="testimonial__swiper swiper">
                    <div class="swiper-wrapper">
                        <article class="testmonial__card swiper-slide">
                            <img src="" alt="image" class="testiomonial__img">

                            <h2 class="testiomonial__title">Ayyoub</h2>
                            <p class="testimonial__description">
                                The Soft livel books are amazing guys
                            </p>
                        </article>
                        <article class="testmonial__card swiper-slide">
                            <img src="" alt="image" class="testiomonial__img">

                            <h2 class="testiomonial__title">Ayyoub</h2>
                            <p class="testimonial__description">
                                The Soft livel books are amazing guys
                            </p>
                        </article>
                        <article class="testmonial__card swiper-slide">
                            <img src="" alt="image" class="testiomonial__img">

                            <h2 class="testiomonial__title">Ayyoub</h2>
                            <p class="testimonial__description">
                                The Soft livel books are amazing guys
                            </p>
                        </article>
                        <article class="testmonial__card swiper-slide">
                            <img src="" alt="image" class="testiomonial__img">

                            <h2 class="testiomonial__title">Ayyoub</h2>
                            <p class="testimonial__description">
                                The Soft livel books are amazing guys
                            </p>
                        </article>
                        <article class="testmonial__card swiper-slide">
                            <img src="" alt="image" class="testiomonial__img">

                            <h2 class="testiomonial__title">Ayyoub</h2>
                            <p class="testimonial__description">
                                The Soft livel books are amazing guys
                            </p>
                        </article>
                        <article class="testmonial__card swiper-slide">
                            <img src="" alt="image" class="testiomonial__img">

                            <h2 class="testiomonial__title">Ayyoub</h2>
                            <p class="testimonial__description">
                                The Soft livel books are amazing guys
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>

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

    <!--========== SCROLL UP ==========-->
    <a href="" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-circle-fill"></i>
    </a>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="./js/scrollreveal.min.js"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="./js/swiper-bundle.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="./js/main.js"></script>
</body>

</html>