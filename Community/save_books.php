<?php
session_start();
require '../config.php'; // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Check if UserID is set in session
        if (!isset($_SESSION['UserID'])) {
            die("User ID not found in session.");
        }

        $user_id = $_SESSION['UserID'];
        $book_title = isset($_POST['title']) ? $_POST['title'] : '';
        $author_name = isset($_POST['author']) ? $_POST['author'] : '';
        $goal = isset($_POST['goal']) ? $_POST['goal'] : '';
        $reading_status = isset($_POST['reading_status']) ? $_POST['reading_status'] : '';

        // Handle file upload
        $cover_image = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
            $cover_image_temp = $_FILES['cover_image']['tmp_name'];
            $cover_image = file_get_contents($cover_image_temp); // Get binary data of the image
        }

        $stmt = $conn->prepare("INSERT INTO saved_books (UserID, BookTitle, AuthorName, CoverImage, Goal, ReadingStatus) 
                                VALUES (:user_id, :book_title, :author_name, :cover_image, :goal, :reading_status)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':book_title', $book_title);
        $stmt->bindParam(':author_name', $author_name);
        $stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_LOB); // Bind image data as BLOB
        $stmt->bindParam(':goal', $goal);
        $stmt->bindParam(':reading_status', $reading_status);

        if ($stmt->execute()) {
            // Redirect to a success page after successful insert
            header('Location: profile.php'); // Replace with your success page URL
            exit();
        } else {
            echo "Error saving book";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/upload.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class="ri-book-3-line"></i> <span class="logo_name">SocialBook's</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="Community.php">
                    <i class="ri-community-line"></i>
                    <span class="link_name">Community</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Community</a></li>
                </ul>
            </li>
            <li>
                <a href="profile.php">
                    <i class="ri-bookmark-line"></i>
                    <span class="link_name">Saved Books</span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="link_name" href="#">Saved Books</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="upload.php">
                    <i class="ri-upload-line"></i>
                    <span class="link_name">Upload a Book</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Upload a Book</a></li>
                </ul>
            </li>
            <li>
                <a href="userProfile.php">
                    <i class="ri-user-line"></i>
                    <span class="link_name">User Information</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">User Information</a></li>
                </ul>
            </li>
            <li>
                <a href="../logout.php">
                    <i class="ri-logout-circle-line"></i></i>
                    <span class="linkname">Log out</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Log out</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <section class="container">
        <div class="logo">
            <a href="choose_action.html" class="nav__logo">
                <i class="ri-book-3-line"></i> Community
            </a>
        </div>
        <header>Save Book</header>
        <div id="upload-form">
            <header>Book Information</header>
            <form action="" method="post" class="form" enctype="multipart/form-data" id="upload-book-form">
                <div class="image">
                    <label for="input-file" id="drop-area">
                        <div id="img-view">
                            <i class="ri-upload-cloud-2-line"></i>
                            <p>Click here to upload image</p>
                        </div>
                        <input type="file" name="cover_image" id="input-file" accept="image/*" required hidden>
                    </label>
                </div>
                <div class="separator"></div>
                <div class="input-fields">
                    <div class="input-box">
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Enter book title" required />
                    </div>
                    <div class="input-box">
                        <label>Author</label>
                        <input type="text" name="author" placeholder="Enter author name" required />
                    </div>
                    <div class="input-box">
                        <label>Goal</label>
                        <input type="text" name="goal" placeholder="Enter your goal for this book" required />
                    </div>
                    <div class="input-box">
                        <label>Status</label>
                        <select name="reading_status" required>
                            <option value="to-read">To Read</option>
                            <option value="reading">Reading</option>
                            <option value="read">Read</option>
                        </select>
                    </div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        const dropArea = document.getElementById('drop-area');
        const inputFile = document.getElementById('input-file');
        const imageView = document.getElementById('img-view');

        dropArea.addEventListener('click', () => {
            inputFile.click();
        });

        inputFile.addEventListener('change', uploadImage);

        function uploadImage() {
            let imgLink = URL.createObjectURL(inputFile.files[0]);
            imageView.style.backgroundImage = `url(${imgLink})`;
            imageView.textContent = '';
            imageView.style.border = 0;
        }
    </script>
</body>

</html>