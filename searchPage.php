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
                            <!-- Department Category Placeholder -->
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
                    <label><input type="checkbox" name="category" value="action"> Action (19)</label>
                    <label><input type="checkbox" name="category" value="fiction"> Fiction (7)</label>
                    <label><input type="checkbox" name="category" value="romance"> Romance (8)</label>
                    <label><input type="checkbox" name="category" value="fantasy"> Fantasy (14)</label>
                </section>

                <section>
                    <h2>Authors</h2>
                    <label><input type="checkbox" name="author" value="J.K. Rowling"> J.K. Rowling</label>
                    <label><input type="checkbox" name="author" value="Stephen King"> Stephen King</label>
                    <label><input type="checkbox" name="author" value="Jane Austen"> Jane Austen</label>
                    <label><input type="checkbox" name="author" value="Harper Lee"> Harper Lee</label>
                </section>

                <section>
                    <h2>Language</h2>
                    <label><input type="checkbox" name="language" value="English"> English</label>
                    <label><input type="checkbox" name="language" value="Spanish"> Spanish</label>
                    <label><input type="checkbox" name="language" value="French"> French</label>
                    <label><input type="checkbox" name="language" value="German"> German</label>
                </section>



            </aside>
            <div class="popular__container container">
                <div class="popular__grid" id="popularGrid">
                    <!-- Search results will be injected here -->
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
                            <a href="" class="footer__link">Privacy policy</a>
                        </li>
                        <li>
                            <a href="" class="footer__link"> Terms of services</a>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew"; // Replace with your actual API key
            const popularGrid = document.getElementById('popularGrid');
            const filters = document.querySelectorAll('.filters input[type="checkbox"]');

            // Function to fetch books based on selected filters
            function fetchBooks() {
                const selectedFilters = getSelectedFilters();
                let url = `https://www.googleapis.com/books/v1/volumes?key=${API_KEY}&q=`;

                const query = Object.entries(selectedFilters)
                    .map(([key, value]) => {
                        if (value.length > 0) {
                            return `${key}:${value.join('|')}`;
                        }
                        return '';
                    })
                    .filter(queryPart => queryPart !== '')
                    .join('+');

                url += query;

                console.log("API URL:", url); // Debugging

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log("API Response:", data); // Debugging
                        displayBooks(data.items);
                    })
                    .catch(error => {
                        console.error("Error fetching books:", error);
                    });
            }


            // Function to get selected filters
            function getSelectedFilters() {
                const selectedFilters = {
                    category: [],
                    author: [],
                    language: []
                };

                filters.forEach(filter => {
                    if (filter.checked) {
                        selectedFilters[filter.name].push(filter.value);
                    }
                });

                return selectedFilters;
            }

            // Function to display books
            function displayBooks(books) {
                popularGrid.innerHTML = '';
                if (!books || books.length === 0) {
                    popularGrid.innerHTML = '<p>No results found.</p>';
                    return;
                }

                books.forEach(book => {
                    const bookInfo = book.volumeInfo;

                    // Create a new card for the book
                    const card = document.createElement("a");
                    card.href = bookInfo.previewLink || "#"; // Link to Google Books preview or fallback to '#'
                    card.classList.add("popular__card", "swiper-slide");
                    card.target = "_blank"; // Open link in a new tab

                    // Create the image element for the book cover
                    const img = document.createElement("img");
                    img.src = bookInfo.imageLinks?.thumbnail || 'default-thumbnail.jpg'; // Fallback image
                    img.alt = `${bookInfo.title} cover`;
                    img.classList.add("popular__img");

                    // Create the content for the book card
                    const content = document.createElement("div");
                    content.classList.add("popular__content");
                    content.innerHTML = `
                <h2 class="popular__title">${bookInfo.title}</h2>
                <div class="popular__author">${bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Author"}</div>
                <div class="popular__stars">${bookInfo.averageRating || 'No Rating'} <i class="ri-star-fill"></i></div>
                <button class="PopularButton">Details</button>
            `;

                    // Append image and content to the card
                    card.appendChild(img);
                    card.appendChild(content);

                    // Append the card to the container
                    popularGrid.appendChild(card);
                });
            }

            // Event listener for changes in checkboxes
            filters.forEach(filter => {
                filter.addEventListener('change', () => {
                    fetchBooks();
                });
            });
        });
    </script>
</body>

</html>