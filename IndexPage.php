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
    <link rel="stylesheet" href="">

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
                        <a href="#Home" class="nav__link">
                            <i class="ri-home-line"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#Books" class="nav__link">
                            <i class="ri-booklet-line"></i>
                            <span>Book's</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#Community" class="nav__link">
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

        </section>

        <!--==================== SERVICES ====================-->
        <section class="services section">

        </section>

        <!--==================== FEATURED ====================-->
        <section class="featured section" id="featured">

        </section>

        <!--==================== DISCOUNT ====================-->
        <section class="discount section" id="discount">

        </section>

        <!--==================== NEW BOOKS ====================-->
        <section class="new section" id="new">

        </section>

        <!--==================== JOIN ====================-->
        <section class="join section">

        </section>

        <!--==================== TESTIMONIAL ====================-->
        <section class="testimonial section" id="testimonial">

        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer">

    </footer>

    <!--========== SCROLL UP ==========-->


    <!--=============== SCROLLREVEAL ===============-->
    <script src=""></script>

    <!--=============== SWIPER JS ===============-->
    <script src=""></script>

    <!--=============== MAIN JS ===============-->
    <script src="./js/main.js"></script>
</body>

</html>