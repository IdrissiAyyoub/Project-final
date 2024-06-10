<?php
session_start(); // Start the session if not already started

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pfe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve UserID from session
$UserID = $_SESSION['UserID'] ?? null;

if (!$UserID) {
    header("Location: register/login.php"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookID = $_POST['bookID'];
    $userComment = $_POST['user-comment'];
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['book-pdf-upload']['name']);

    // Check if the uploads directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Verify if BookID exists in the books table
    $stmt = $conn->prepare("SELECT BookID FROM books WHERE BookID = ?");
    $stmt->bind_param("i", $bookID);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // BookID exists, proceed with file upload
        if (move_uploaded_file($_FILES['book-pdf-upload']['tmp_name'], $uploadFile)) {
            $pdfPath = $uploadFile;

            $stmt = $conn->prepare("INSERT INTO sharedbooks (UserID, BookID, Comment, PDFPath) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $UserID, $bookID, $userComment, $pdfPath);

            if ($stmt->execute()) {
                header("Location: success.php"); // Redirect to a success page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Possible file upload attack!";
        }
    } else {
        echo "Invalid BookID. Please select a valid book.";
    }
}

$conn->close();
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
                        <a href="<?php echo isset($_SESSION['UserID']) ? '#' : 'register/login.php'; ?>" id="shareButton"><i class="ri-share-forward-line"></i> Share</a>
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
                        <li><a href="" class="footer__link">Contact Us</a></li>
                        <li><a href="" class="footer__link">Support</a></li>
                        <li><a href="" class="footer__link">Affiliates</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer__social">
            <a href="#" class="footer__social-link"><i class="ri-facebook-line"></i></a>
            <a href="#" class="footer__social-link"><i class="ri-twitter-line"></i></a>
            <a href="#" class="footer__social-link"><i class="ri-instagram-line"></i></a>
        </div>
        <p class="footer__copy">&#169; 2024 SocialBook's. All rights reserved.</p>
    </footer>

    <script src="./js/swiper-bundle.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>