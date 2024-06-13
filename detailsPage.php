<?php
session_start(); // Start the session
require_once './config.php';
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
                    <div class="share-section">
                        <a href="#" id="saveButton"><i class="ri-save-line"></i> Save</a>

                        <a href="#" id="shareButton"><i class="ri-share-forward-line"></i> Share</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="description">
            <h2>Description:</h2>
            <p id="book-description"></p>
        </div>


        <div id="shareModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="shareForm" action="submit.php" method="POST" enctype="multipart/form-data">
                    <!-- Comment Section -->
                    <div class="modal-comment-section">
                        <input type="text" name="user-comment" id="user-comment" placeholder="Enter your comment or opinion">
                    </div>
                    <!-- Book Information -->
                    <div class="modal-book-info">
                        <img id="modal-book-cover" src="" alt="Book Cover">
                        <div>
                            <h2 class="popular__title" id="modal-book-title">Book Title</h2>
                            <div class="popular__author" id="modal-book-authors">Author Name</div>
                            <div class="popular__stars" id="modal-book-rating">Rating</div>
                        </div>
                    </div>
                    <!-- PDF Upload Section -->
                    <div class="modal-comment-section">
                        <p>If you have the PDF of this book, please upload it to help the community:</p>
                        <input type="file" name="book-pdf-upload" id="book-pdf-upload" accept=".pdf">
                    </div>
                    <input type="hidden" name="bookID" id="modal-bookID">
                    <div class="modal-footer">
                        <button type="submit" class="button" id="submit-comment">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="saveModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="book-info-container"></div>
                <select id="readingStatus">
                    <option value="to-read">To Read</option>
                    <option value="reading">Reading</option>
                    <option value="read">Read</option>
                </select>
                <button id="saveModalSaveBtn">Save</button>
            </div>
        </div>
        <button id="saveButton">Save Book</button>

    </main>
    <h2>More like that :</h2>

    <footer class="footer">
        <div class="footer__container container grid">
            <div>
                <a href="#" class="footer__logo">
                    <i class="ri-book-3-line"></i> SocialBook's
                </a>
                <p class="footer__description">
                    Discover your next favorite book
                </p>
            </div>
            <div class="footer__content">
                <div class="footer__data">
                    <h3 class="footer__subtitle">About</h3>
                    <ul>
                        <li><a href="#" class="footer__link">About Us</a></li>
                        <li><a href="#" class="footer__link">Features</a></li>
                        <li><a href="#" class="footer__link">New</a></li>
                        <li><a href="#" class="footer__link">Blog</a></li>
                    </ul>
                </div>
                <div class="footer__data">
                    <h3 class="footer__subtitle">Company</h3>
                    <ul>
                        <li><a href="#" class="footer__link">Team</a></li>
                        <li><a href="#" class="footer__link">Plan Pricing</a></li>
                        <li><a href="#" class="footer__link">Become a member</a></li>
                        <li><a href="#" class="footer__link">Sponsorship</a></li>
                    </ul>
                </div>
                <div class="footer__data">
                    <h3 class="footer__subtitle">Support</h3>
                    <ul>
                        <li><a href="#" class="footer__link">FAQs</a></li>
                        <li><a href="#" class="footer__link">Support center</a></li>
                        <li><a href="#" class="footer__link">Contact us</a></li>
                    </ul>
                </div>
                <div class="footer__data">
                    <h3 class="footer__subtitle">Follow us</h3>
                    <ul class="footer__social">
                        <a href="#" class="footer__social-link"><i class="ri-facebook-fill"></i></a>
                        <a href="#" class="footer__social-link"><i class="ri-instagram-fill"></i></a>
                        <a href="#" class="footer__social-link"><i class="ri-twitter-fill"></i></a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__info container">
            <span class="footer__copy">&#169; SocialBook's. All rights reserved</span>
            <div class="footer__privacy">
                <a href="#">Terms & Agreements</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <script src="./js/swiper-bundle.min.js"></script>
    <script src="./js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const API_KEY = "AIzaSyBoRapgZn6sbfT03pNKLC-fCVyPeuzN7ew";
            const urlParams = new URLSearchParams(window.location.search);
            const bookId = urlParams.get('id');

            if (bookId) {
                fetchBookDetails(bookId);
            } else {
                console.error("Book ID not found in URL parameters.");
            }

            function fetchBookDetails(id) {
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
                            setupModal(data.volumeInfo, id);
                        } else {
                            throw new Error('No data received from API or invalid book ID');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching book details:', error);
                    });
            }

            function displayBookDetails(bookInfo) {
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

                document.getElementById('preview-link').href = bookInfo.previewLink || "#";
                document.getElementById('info-link').href = bookInfo.infoLink || "#";
                document.getElementById('web-reader-link').href = bookInfo.canonicalVolumeLink || "#";
            }

            function setupModal(bookInfo, bookId) {
                document.getElementById('modal-book-cover').src = bookInfo.imageLinks?.thumbnail || 'default-thumbnail.jpg';
                document.getElementById('modal-book-title').textContent = bookInfo.title || 'Unknown Title';
                document.getElementById('modal-book-authors').textContent = `Authors: ${bookInfo.authors ? bookInfo.authors.join(", ") : "Unknown Authors"}`;
                document.getElementById('modal-book-rating').textContent = `Rating: ${bookInfo.averageRating || 'N/A'}`;
                document.getElementById('modal-bookID').value = bookId;
            }

            const shareModal = document.getElementById("shareModal");
            const shareCloseButton = shareModal.querySelector(".close");
            const saveButton = document.getElementById("saveButton");
            const saveModal = document.getElementById("saveModal");
            const saveModalCloseButton = saveModal.querySelector(".close");
            const saveModalSaveBtn = document.getElementById("saveModalSaveBtn");

            // Event listener to close the share modal when clicking on the close button
            shareCloseButton.addEventListener("click", () => {
                shareModal.style.display = "none";
            });

            // Event listener to close the share modal when clicking outside the modal content
            window.addEventListener("click", (event) => {
                if (event.target == shareModal) {
                    shareModal.style.display = "none";
                }
            });

            // Event listener to open the save modal
            saveButton.addEventListener("click", () => {
                const book = {
                    volumeInfo: {
                        title: document.getElementById('book-title').textContent,
                        authors: Array.from(document.querySelectorAll('.authors p')).map(p => p.textContent.split(': ')[1]),
                        imageLinks: {
                            thumbnail: document.getElementById('book-cover').src
                        }
                    }
                };

                openSaveModal(book);
            });

            // Function to open the save modal with book data
            function openSaveModal(book) {
                saveModal.style.display = "block";

                const img = document.createElement('img');
                img.src = book.volumeInfo.imageLinks ? book.volumeInfo.imageLinks.thumbnail : './Images/default.jpg';
                img.alt = 'image';
                img.classList.add('featured__img');

                const title = document.createElement('h2');
                title.classList.add('featured__title');
                title.textContent = book.volumeInfo.title || 'Untitled';

                const authors = document.createElement('div');
                authors.classList.add('featured__prices');
                const authorsList = book.volumeInfo.authors ? book.volumeInfo.authors.join(', ') : 'Unknown Author';
                authors.innerHTML = `<span class="featured__discount">${authorsList}</span><br>`;

                const bookInfoContainer = document.getElementById('book-info-container');
                bookInfoContainer.innerHTML = '';
                bookInfoContainer.appendChild(img);
                bookInfoContainer.appendChild(title);
                bookInfoContainer.appendChild(authors);
            }

            // Event listener to close the save modal when clicking on the close button
            saveModalCloseButton.addEventListener("click", () => {
                saveModal.style.display = "none";
            });

            // Event listener to close the save modal when clicking outside the modal content
            window.addEventListener("click", (event) => {
                if (event.target == saveModal) {
                    saveModal.style.display = "none";
                }
            });

            // Event listener for the save button inside the modal
            saveModalSaveBtn.addEventListener("click", (event) => {
                event.preventDefault();

                const readingStatus = document.getElementById('readingStatus').value;
                const bookID = document.getElementById('modal-bookID').value;

                const formData = new FormData();
                formData.append('bookID', bookID);
                formData.append('readingStatus', readingStatus);

                fetch('savePage.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Book saved successfully!');
                            saveModal.style.display = "none";
                        } else {
                            alert('Error saving book: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error saving book.');
                    });
            });
        });
    </script>
</body>

</html>