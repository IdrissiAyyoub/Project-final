<?php
session_start();
require '../config.php'; // Adjust the path as needed

try {
    if (!isset($_SESSION['UserID'])) {
        die("User ID not found in session.");
    }

    $user_id = $_SESSION['UserID'];

    // Fetch saved books from the database
    $stmt = $conn->prepare("SELECT SavedBookID, BookTitle, AuthorName, CoverImage, Goal, ReadingStatus FROM saved_books WHERE UserID = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $saved_books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle updating reading status
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update reading status
        if (isset($_POST['update_status']) && isset($_POST['new_status'])) {
            $book_id = $_POST['update_status'];
            $new_status = $_POST['new_status'];

            // Update status for "to-read", "reading", and "read" books
            $update_stmt = $conn->prepare("UPDATE saved_books SET ReadingStatus = :new_status WHERE SavedBookID = :book_id AND UserID = :user_id");
            $update_stmt->bindParam(':new_status', $new_status);
            $update_stmt->bindParam(':book_id', $book_id);
            $update_stmt->bindParam(':user_id', $user_id);

            if ($update_stmt->execute()) {
                if ($new_status === 'read') {
                    // Open feedback modal when status is updated to "read"
                    echo "<script>window.onload = function() { openFeedbackModal($book_id); };</script>";
                } else {
                    header("Location: profile.php");
                    exit;
                }
            } else {
                echo "<script>alert('Error updating reading status');</script>";
            }
        }

        // Handle feedback submission
        if (isset($_POST['submit_feedback'])) {
            $book_id = $_POST['book_id'];
            $feedback = $_POST['feedback'];

            $update_stmt = $conn->prepare("UPDATE saved_books SET ReadingStatus = 'read', Description = :feedback WHERE SavedBookID = :book_id AND UserID = :user_id");
            $update_stmt->bindParam(':feedback', $feedback);
            $update_stmt->bindParam(':book_id', $book_id);
            $update_stmt->bindParam(':user_id', $user_id);

            if ($update_stmt->execute()) {
                echo "<script>alert('Thank you for your feedback!');</script>";
                header("Location: profile.php");
                exit;
            } else {
                echo "<script>alert('Error updating reading status');</script>";
            }
        }

        // Handle delete book
        if (isset($_POST['delete_book'])) {
            $book_id = $_POST['delete_book'];

            $delete_stmt = $conn->prepare("DELETE FROM saved_books WHERE SavedBookID = :book_id AND UserID = :user_id");
            $delete_stmt->bindParam(':book_id', $book_id);
            $delete_stmt->bindParam(':user_id', $user_id);

            if ($delete_stmt->execute()) {
                echo "<script>alert('Book deleted successfully');</script>";
                header("Location: profile.php");
                exit;
            } else {
                echo "<script>alert('Error deleting book');</script>";
            }
        }

        // Handle share book
        if (isset($_POST['share_book'])) {
            $book_id = $_POST['share_book'];

            // Check if the book is already shared by the user
            $check_stmt = $conn->prepare("SELECT * FROM shared_books WHERE UserID = :user_id AND SavedBookID = :book_id");
            $check_stmt->bindParam(':user_id', $user_id);
            $check_stmt->bindParam(':book_id', $book_id);
            $check_stmt->execute();
            $result = $check_stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<script>alert('You have already shared this book.');</script>";
            } else {
                // Insert into shared_books table
                $insert_stmt = $conn->prepare("INSERT INTO shared_books (UserID, SavedBookID, CreatedAt) VALUES (:user_id, :book_id, NOW())");
                $insert_stmt->bindParam(':user_id', $user_id);
                $insert_stmt->bindParam(':book_id', $book_id);

                if ($insert_stmt->execute()) {
                    echo "<script>alert('Book shared successfully');</script>";
                } else {
                    echo "<script>alert('Error sharing book');</script>";
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/profiel.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .tab-navigation {
            text-align: center;
            margin-top: 20px;
        }

        .tab-link {
            background-color: hsl(230, 70%, 16%);
            color: white;
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tab-link:hover {
            background-color: #333;
        }

        .tab-link.active {
            background-color: hsl(230, 16%, 45%);
            color: white;
        }

        .tab-content {
            display: none;
            padding: 20px;
            text-align: center;
        }

        .popular__card {
            align-items: center;
            width: 400px;
            column-gap: 2.5rem;
            background-color: #f0f2ff;
            padding: 1.5rem 1rem;
            color: hsl(230, 16%, 45%);
            border: 2px solid #d9ddf2;
            transition: border .4s, background-color .4s;
        }

        .popular__card:hover {
            border: 2px solid hsl(230, 16%, 45%);
        }

        .popular__img {
            width: 150px;
            height: 200px;
            box-shadow: -8px 9px 11.8px 0px #00000067;
        }

        .popular__title {
            font-size: 1.25rem;
            margin: .9rem 0rem;
        }

        .popular__prices {
            display: flex;
            align-items: center;
            column-gap: .75rem;
            margin-bottom: .75rem;
        }

        .popular__author {
            color: hsl(230, 70%, 16%);
            margin-top: .5rem;
        }

        .popular__goal {
            color: hsl(230, 16%, 55%);
            margin-top: .5rem;
        }

        .popular__stars {
            color: #4960d4;
        }

        select {
            padding: .5rem;
            border: 2px solid #d9ddf2;
            border-radius: 5px;
            background-color: #fff;
            font-size: 1rem;
            margin-top: .5rem;
            cursor: pointer;
            transition: border .4s;
        }

        select:focus {
            border-color: #4960d4;
            outline: none;
        }

        button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            color: #4960d4;
            transition: color .4s;
        }

        button:hover {
            color: #1f3bb3;
        }

        .card-actions {
            display: flex;
            flex-direction: column;
            row-gap: .5rem;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #ddd;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-content h2 {
            margin-top: 0;
            font-size: 1.8rem;
            color: #333;
        }

        .modal-content textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
        }

        .modal-content button {
            background-color: #4960d4;
            color: hsl(0, 0%, 100%);
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            cursor: pointer;
            font-size: .938rem;
            transition: box-shadow 0.4s;
            margin-top: 19px;
        }

        .modal-content button:hover {
            background-color: #5a6bc1;
        }

        .card-actions {
            display: flex;
            align-items: center;
            column-gap: .5rem;

        }

        .card-actions button i {
            background: none;
            border: 2px solid #4960d4;
            cursor: pointer;
            padding: .4rem;
            font-size: 1.45rem;
            color: #4960d4;
            transition: color .4s;
        }

        .card-actions button:hover {
            color: #1f3bb3;
        }

        .statusDelete {

            display: flex;
            align-items: center;
            margin-top: 10px;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <!-- Sidebar and Navigation -->
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
        </ul>
    </div>

    <section class="home-section">
        <div class="tab-navigation">
            <button class="tab-link active" onclick="openTab(event, 'toRead')">To-Read</button>
            <button class="tab-link" onclick="openTab(event, 'reading')">Reading</button>
            <button class="tab-link" onclick="openTab(event, 'read')">Read</button>
        </div>

        <div id="toRead" class="tab-content" style="display: block;">
            <?php foreach ($saved_books as $book) : ?>
                <?php if ($book['ReadingStatus'] == 'to-read') : ?>
                    <div class="popular__card">
                        <img src="data:image/jpeg;base64,<?= base64_encode($book['CoverImage']) ?>" alt="Cover Image" class="popular__img">
                        <div>
                            <h1 class="popular__title"><?php echo htmlspecialchars($book['BookTitle']); ?></h1>
                            <span class="popular__author"><?php echo htmlspecialchars($book['AuthorName']); ?></span>
                            <p class="popular__goal"><?php echo htmlspecialchars($book['Goal']); ?></p>
                            <div class="statusDelete">
                                <form action="profile.php" method="POST" class="card-actions">
                                    <input type="hidden" name="update_status" value="<?php echo htmlspecialchars($book['SavedBookID']); ?>">
                                    <select name="new_status" onchange="this.form.submit()">
                                        <option value="to-read">To-Read</option>
                                        <option value="reading">Reading</option>
                                        <option value="read">Read</option>
                                    </select>
                                </form>
                                <form action="profile.php" method="POST" class="card-actions">
                                    <input type="hidden" name="delete_book" value="<?php echo htmlspecialchars($book['SavedBookID']); ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div id="reading" class="tab-content">
            <?php foreach ($saved_books as $book) : ?>
                <?php if ($book['ReadingStatus'] == 'reading') : ?>
                    <div class="popular__card">
                        <img src="data:image/jpeg;base64,<?= base64_encode($book['CoverImage']) ?>" alt="Cover Image" class="popular__img">
                        <div>
                            <h1 class="popular__title"><?php echo htmlspecialchars($book['BookTitle']); ?></h1>
                            <span class="popular__author"><?php echo htmlspecialchars($book['AuthorName']); ?></span>
                            <p class="popular__goal"><?php echo htmlspecialchars($book['Goal']); ?></p>
                            <div class="statusDelete">
                                <form action="profile.php" method="POST" class="card-actions">
                                    <input type="hidden" name="update_status" value="<?php echo htmlspecialchars($book['SavedBookID']); ?>">
                                    <select name="new_status" onchange="this.form.submit()">
                                        <option value="to-read">To-Read</option>
                                        <option value="reading">Reading</option>
                                        <option value="read">Read</option>
                                    </select>
                                </form>
                                <form action="profile.php" method="POST" class="card-actions">
                                    <input type="hidden" name="delete_book" value="<?php echo htmlspecialchars($book['SavedBookID']); ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div id="read" class="tab-content">
            <?php foreach ($saved_books as $book) : ?>
                <?php if ($book['ReadingStatus'] == 'read') : ?>
                    <div class="popular__card">
                        <img src="data:image/jpeg;base64,<?= base64_encode($book['CoverImage']) ?>" alt="Cover Image" class="popular__img">
                        <div>
                            <h1 class="popular__title"><?php echo htmlspecialchars($book['BookTitle']); ?></h1>
                            <span class="popular__author"><?php echo htmlspecialchars($book['AuthorName']); ?></span>
                            <p class="popular__goal"><?php echo htmlspecialchars($book['Goal']); ?></p>
                            <div class="statusDelete">
                               
                                <form action="profile.php" method="POST" class="card-actions">
                                    <input type="hidden" name="delete_book" value="<?php echo htmlspecialchars($book['SavedBookID']); ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?');">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Feedback Modal -->
    <div id="feedback-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeFeedbackModal()">&times;</span>
            <form action="profile.php" method="POST">
                <input type="hidden" name="book_id" id="feedback-book-id">
                <h2>Feedback</h2>
                <textarea name="feedback" rows="4" cols="50" required></textarea>
                <button type="submit" name="submit_feedback">Submit Feedback</button>
            </form>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-link");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function openFeedbackModal(book_id) {
            document.getElementById('feedback-book-id').value = book_id;
            document.getElementById('feedback-modal').style.display = 'block';
        }

        function closeFeedbackModal() {
            document.getElementById('feedback-modal').style.display = 'none';
        }
    </script>
</body>

</html>