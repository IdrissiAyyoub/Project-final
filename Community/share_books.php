<?php
session_start();
require '../config.php'; // Adjust the path as needed

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    die("User ID not found in session.");
}

$user_id = $_SESSION['UserID'];

// Initialize variables for form inputs and errors
$title = $author = $genre = $description = $rating = '';
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $genre = trim($_POST['genre']);
    $description = trim($_POST['description']);
    $rating = intval($_POST['rating']);

    // Handle cover image upload
    $cover_image = null;
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
        $cover_image_temp = $_FILES['cover_image']['tmp_name'];
        $cover_image = file_get_contents($cover_image_temp); // Get binary data of the image

        // Allow only certain file formats
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'jfif');
        $imageFileType = strtolower(pathinfo($_FILES['cover_image']['name'], PATHINFO_EXTENSION));
        if (!in_array($imageFileType, $allowed_types)) {
            $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $errors[] = "Please select a file to upload.";
    }

    // If no errors, proceed with inserting into database
    if (empty($errors)) {
        try {
            // Prepare INSERT statement
            $insert_stmt = $conn->prepare("INSERT INTO books (UserID, Title, Author, Genre, Description, CoverImage, Rating) VALUES (:user_id, :title, :author, :genre, :description, :cover_image, :rating)");

            // Bind parameters
            $insert_stmt->bindParam(':user_id', $user_id);
            $insert_stmt->bindParam(':title', $title);
            $insert_stmt->bindParam(':author', $author);
            $insert_stmt->bindParam(':genre', $genre);
            $insert_stmt->bindParam(':description', $description);
            $insert_stmt->bindParam(':cover_image', $cover_image, PDO::PARAM_LOB); // Store image as blob
            $insert_stmt->bindParam(':rating', $rating);

            // Execute the query
            if ($insert_stmt->execute()) {
                echo "<script>alert('Book shared successfully!');</script>";
                header("Location: Community.php");
                exit;
            } else {
                echo "<script>alert('Error sharing book');</script>";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    } else {
        // Output errors as JavaScript alerts
        foreach ($errors as $error) {
            echo "<script>alert('Error: " . $error . "');</script>";
        }
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
                    <span class="link_name">Log out</span>
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
        <header>Share Book</header>
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
                        <input type="text" name="title" placeholder="Enter book title" required value="<?= htmlspecialchars($title) ?>" />
                    </div>
                    <div class="input-box">
                        <label>Author</label>
                        <input type="text" name="author" placeholder="Enter author name" required value="<?= htmlspecialchars($author) ?>" />
                    </div>
                    <div class="input-box">
                        <label>Genre</label>
                        <input type="text" name="genre" placeholder="Enter genre" value="<?= htmlspecialchars($genre) ?>" />
                    </div>
                    <div class="input-box">
                        <label>Description</label>
                        <textarea name="description" placeholder="Enter book description" rows="4"><?= htmlspecialchars($description) ?></textarea>
                    </div>
                    <div class="input-box">
                        <label>Rating</label>
                        <input type="number" name="rating" placeholder="Enter rating (1-5)" min="1" max="5" required value="<?= htmlspecialchars($rating) ?>" />
                    </div>
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
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