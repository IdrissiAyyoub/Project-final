<?php
session_start(); // Start the session
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="./css/swiper-bundle.min.css">
    <link rel="stylesheet" href="./css/detailsPage.css">
    <title>Document</title>
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="./IndexPage.php" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>
            <div class="nav__menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="./IndexPage.php" class="nav__link active-link">
                            <i class="ri-home-line"></i>
                            <span>Home</span>
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
                <span class="login__signup">You do not have an account? <a href="#">Sign up</a></span>
                <?php if (!isset($_SESSION['UserID'])) : ?>
                    <!-- Display the button if the user is not logged in -->
                    <button type="submit" class="login__button button">Log In</button>
                <?php endif; ?>
            </div>
        </form>
        <i class="ri-close-line login__close" id="login-close"></i>
    </div>

    <br>

    <main>
        <section class="book-details">
            <div class="book-cover">
                <img id="book-cover" src="" alt="Book Cover">
            </div>
            <div class="book-info">
                <h1 id="book-title">Book Title</h1>
                <p class="rating" id="book-rating">Rating: </p>
                <p class="genre" id="book-genre">Genre: </p>
                <div class="authors">
                    <p><strong>Authors:</strong></p>
                    <p><strong>Publisher:</strong></p>
                    <p><strong>Published Date:</strong></p>
                    <p><strong>Page Count:</strong></p>
                    <p><strong>ISBN-10:</strong></p>
                    <p><strong>ISBN-13:</strong></p>
                    <p><strong>Language:</strong></p>
                </div>
                <div class="links">
                    <p><strong>Links:</strong></p>
                    <div class="link-section">
                        <a href="#" id="preview-link">Preview</a>
                        <a href="#" id="info-link">Info</a>
                        <a href="#" id="web-reader-link">Web Reader</a>
                    </div>

                </div>
            </div>
        </section>

        <div class="description">
            <h2>Description:</h2>
            <p id="book-description"></p>
        </div>

        <h2>More like that :</h2>
        <section class="popular section" id="popular">
            <div class="popular__container container">
                <div class="popular__swiper swiper">
                    <div class="swiper-wrapper"></div>
                </div>
            </div>
        </section>
    </main>

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

    <script src="./js/swiper-bundle.min.js"></script>
    <script src="./js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const urlParams = new URLSearchParams(window.location.search);
            const bookId = urlParams.get('id');

            if (bookId) {
                fetchBookDetails(bookId);
            } else {
                console.error("Book ID not found in URL parameters.");
            }

            function fetchBookDetails(id) {
                const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew";
                const API_ENDPOINT = `https://www.googleapis.com/books/v1/volumes/${id}?key=${API_KEY}`;

                fetch(API_ENDPOINT)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.volumeInfo) {
                            displayBookDetails(data.volumeInfo);
                            const firstGenre = data.volumeInfo.categories ? data.volumeInfo.categories[0] : null;
                            if (firstGenre) {
                                fetchSimilarBooks(firstGenre);
                            } else {
                                console.error('No genre information available for this book.');
                            }
                        } else {
                            throw new Error('No data received from API or invalid book ID');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching book details:', error);
                    });
            }

            function displayBookDetails(bookInfo) {
                // Display book details
                document.getElementById('book-cover').src = bookInfo.imageLinks?.thumbnail || 'default-thumbnail.jpg';
                document.getElementById('book-title').textContent = bookInfo.title || 'Unknown Title';
                document.getElementById('book-rating').textContent = `Rating: ${bookInfo.averageRating || 'N/A'}`;
                document.getElementById('book-genre').textContent = `Genre: ${bookInfo.categories ? bookInfo.categories.join(", ") : "Unknown Genre"}`;
                document.getElementById('book-description').textContent = bookInfo.description || "No description available.";
                document.querySelector('.authors').innerHTML = `
                <p><strong>Authors:</strong> ${bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Authors"}</p>
                <p><strong>Publisher:</strong> ${bookInfo.publisher || "Unknown Publisher"}</p>
                <p><strong>Published Date:</strong> ${bookInfo.publishedDate || "Unknown Date"}</p>
                <p><strong>Page Count:</strong> ${bookInfo.pageCount || "N/A"}</p>
                <p><strong>ISBN-10:</strong> ${bookInfo.industryIdentifiers ? bookInfo.industryIdentifiers.find(identifier => identifier.type === 'ISBN_10')?.identifier : "N/A"}</p>
                <p><strong>ISBN-13:</strong> ${bookInfo.industryIdentifiers ? bookInfo.industryIdentifiers.find(identifier => identifier.type === 'ISBN_13')?.identifier : "N/A"}</p>
                <p><strong>Language:</strong> ${bookInfo.language || "N/A"}</p>
            `;
            }

            function fetchSimilarBooks(genre) {
                const encodedGenre = encodeURIComponent(genre);
                const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew";
                const API_ENDPOINT = `https://www.googleapis.com/books/v1/volumes?q=subject:${encodedGenre}&orderBy=relevance&printType=books&key=${API_KEY}`;

                fetch(API_ENDPOINT)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const ratedBooks = data.items.filter(book => book.volumeInfo.averageRating);
                        ratedBooks.sort((a, b) => b.volumeInfo.averageRating - a.volumeInfo.averageRating);
                        const popularBooksContainer = document.querySelector("#popular .popular__swiper .swiper-wrapper");
                        popularBooksContainer.innerHTML = "";

                        ratedBooks.forEach(book => {
                            const bookInfo = book.volumeInfo;

                            const card = document.createElement("a");
                            card.href = `./detailsPage.php?id=${book.id}`;
                            card.classList.add("popular__card", "swiper-slide");

                            const img = document.createElement("img");
                            img.src = bookInfo.imageLinks?.thumbnail || 'default-thumbnail.jpg';
                            img.alt = "Book cover";
                            img.classList.add("popular__img");

                            const content = document.createElement("div");
                            content.innerHTML = `
                            <h2 class="popular__title">${bookInfo.title}</h2>
                            <div class="popular__prices">
                                <span class="popular__author">${bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Author"}</span>
                            </div>
                            <div class="popular__stars">
                                ${bookInfo.averageRating} <i class="ri-star-fill"></i>
                            </div>
                            <div>
                                <a href="./detailsPage.php?id=${book.id}" class="PopularButton">Details</a>
                            </div>
                        `;

                            card.appendChild(img);
                            card.appendChild(content);
                            popularBooksContainer.appendChild(card);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching similar books:', error);
                    });
            }
        });
    </script>


</body>

</html>