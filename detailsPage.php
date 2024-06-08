<?php
session_start(); // Start the session if not already started
$UserID = $_SESSION['UserID']; // Retrieve UserID from session
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
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .modal-body {
            margin: 15px 0;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #ddd;
        }

        .button {
            display: inline-block;
            background-color: #4960d4;
            width: 100%;
            color: white;
            margin: 1rem;
            padding: 1rem 1.5rem;
            transition: box-shadow .4s;

        }

        .button-secondary {
            background-color: #6c757d;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button-secondary:hover {
            background-color: #5a6268;
        }

        .modal-comment-section {
            margin-bottom: 20px;
        }

        .modal-comment-section input {
            background-color: #f0f2ff;
            color: #606785;
            width: 100%;
            border-bottom: 2px solid #d9ddf2;
            padding: 1rem;
        }

        .modal-book-info {
            display: flex;
            align-items: flex-start;
            /* Align items to the start */
            margin-bottom: 20px;
            border: 2px solid #d9ddf2;
            padding: 2rem;
        }

        .modal-book-cover img {
            width: 100px;
            height: auto;
            box-shadow: -8px 9px 11.8px 0px #00000067;
            margin-right: 20px;
        }

        .modal-book-details {
            display: flex;
            flex-direction: column;
            margin-left: 1.4rem;
        }

        .modal__title {
            font-size: var(--h2-font-size);
            margin-bottom: .5rem;
        }

        .modal__prices {
            display: flex;
            flex-direction: column;
            /* Change direction to column */
            align-items: flex-start;
            /* Align items to the start */
            margin-bottom: .75rem;
        }

        .modal__author {
            color: #0c1645;
            margin-top: .5rem;
        }

        .modal__stars {

            color: #4960d4;
        }

        .PopularButton {
            display: none;
            /* Hide the details button */
        }
    </style>
    <title>Document</title>
</head>

<body>
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
                <button type="submit" class="login__button button">Log In</button>
            </div>
        </form>
        <i class="ri-close-line login__close" id="login-close"></i>
    </div>
    <br>
    <main>
        <section class="book-details">
            <div class="book-cover">
                <img id="book-cover" src="http://books.google.com/books/content?id=KY2Om6YFseEC&printsec=frontcover&img=1&zoom=1&source=gbs_api" alt="Book Cover">
            </div>
            <div class="book-info">
                <h1 id="book-title">When Dragons Dream</h1>
                <p class="rating" id="book-rating">Rating: N/A</p>
                <p class="genre" id="book-genre">Genre: Romance</p>
                <p class="description" id="book-description">When Dragons Dream by Kathleen O'Brien released on Sep 24, 1993 is available now for purchase.</p>
                <div class="authors">
                    <p><strong>Authors:</strong> Kathleen O'Brien</p>
                    <p><strong>Publisher:</strong> Harlequin Books</p>
                    <p><strong>Published Date:</strong> 1993</p>
                    <p><strong>Page Count:</strong> 228</p>
                    <p><strong>ISBN-10:</strong> 0373116004</p>
                    <p><strong>ISBN-13:</strong> 9780373116003</p>
                    <p><strong>Language:</strong> English</p>
                </div>
                <div class="links">
                    <p><strong>Links :</strong></p>
                    <div class="link-section">
                        <a href="http://books.google.com/books?id=KY2Om6YFseEC&q=query+subject:romance&dq=query+subject:romance&hl=&cd=1&source=gbs_api" id="preview-link">Preview</a>
                        <a href="http://books.google.com/books?id=KY2Om6YFseEC&dq=query+subject:romance&hl=&source=gbs_api" id="info-link">Info</a>
                        <a href="http://play.google.com/books/reader?id=KY2Om6YFseEC&hl=&source=gbs_api" id="web-reader-link">Web Reader</a>
                    </div>
                    <div class="share-section">
                        <a href="#" id="shareButton"><i class="ri-share-forward-line"></i> Share</a>
                        <a href="#"><i class="ri-save-line"></i> Save</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer__container container grid">
            <div>
                <a href="" class="footer__logo"><i class="ri-book-3-line"></i> SocialBook's</a>
                <p class="footer__description">Where Readers Connect and Share Their Literary Adventures.</p>
            </div>
            <div class="footer__data grid">
                <div>
                    <h3 class="footer__title">About</h3>
                    <ul class="footer__links">
                        <li><a href="" class="footer__link">Awards</a></li>
                        <li><a href="" class="footer__link">FAQs</a></li>
                        <li><a href="" class="footer__link">Privacy policy</a></li>
                        <li><a href="" class="footer__link">Terms of services</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Links</h3>
                    <ul class="footer__links">
                        <li><a href="" class="footer__link">Home</a></li>
                        <li><a href="" class="footer__link">Community</a></li>
                        <li><a href="" class="footer__link">Search</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer__title">Contact</h3>
                    <ul class="footer__links">
                        <li><a href="" class="footer__link">Email</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <span class="footer__copy">&#169 ; All Rights Reserved By SocialBook's</span>
    </footer>

    <div id="shareModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="comment-form" action="submit_comment.php" method="post" enctype="multipart/form-data">
                <div class="modal-comment-section">
                    <input type="hidden" name="bookID" id="bookId" value="">
                    <input type="text" name="comment" id="user-comment" placeholder="Enter your comment or opinion">
                </div>
                <div class="modal-book-info">
                    <div class="modal-book-cover">
                        <img id="modal-book-cover" src="" alt="Book Cover">
                    </div>
                    <div class="modal-book-details">
                        <h2 class="modal__title" id="modal-book-title"></h2>
                        <p id="modal-book-rating"></p>
                        <p id="modal-book-genre"></p>
                        <p id="modal-book-authors"></p>
                    </div>
                </div>
                <div class="modal-comment-section">
                    <p>If you have the PDF of this book, please upload it to help the community:</p>
                    <input type="file" id="book-pdf-upload" accept=".pdf">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="button">Submit</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Scripts -->
    <script src="./js/scrollreveal.min.js"></script>
    <script src="./js/swiper-bundle.min.js"></script>
    <script src="./js/main.js"></script>

</body>

</html>