<?php
require '../config.php'; // Adjust the path as per your file structure

session_start();
$user_id = $_SESSION['UserID'] ?? null; // Ensure $user_id is set or null if not

// Handle new comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment']) && isset($_POST['book_id'])) {
    $comment = trim($_POST['comment']);
    $book_id = intval($_POST['book_id']);

    if ($comment && $book_id && $user_id) {
        $sql = "INSERT INTO comments (UserID, BookID, Comment) VALUES (:user_id, :book_id, :comment)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->execute();
    }
}

// Fetch user information
$username = $fullname = $profilePicture = '';
$booksShared = $booksRead = 0;
$users = $books = [];

try {
    if (!$user_id) {
        throw new Exception("User ID not found in session.");
    }

    // Fetch user information
    $sql = "SELECT Username, FullName, ProfilePicture FROM users WHERE UserID = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $username = $user['Username'];
        $fullname = $user['FullName'];
        $profilePicture = $user['ProfilePicture'];
    } else {
        throw new Exception("User not found in database.");
    }

    // Count books shared
    $sql = "SELECT COUNT(*) AS shared_count FROM books WHERE UserID = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $booksShared = $result['shared_count'];

    // Count books read
    $sql = "SELECT COUNT(*) AS read_count FROM saved_books WHERE UserID = :user_id AND ReadingStatus = 'read'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $booksRead = $result['read_count'];

    // Fetch list of users for search results, excluding the current user
    $sql = "SELECT UserID, Username, FullName, ProfilePicture FROM users WHERE UserID != :user_id LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all book posts sorted by creation time (latest first)
    $sqlBooks = "SELECT books.*, users.Username, users.FullName, users.ProfilePicture,
                 (SELECT COUNT(*) FROM likes WHERE likes.BookID = books.BookID) AS like_count,
                 (SELECT COUNT(*) FROM likes WHERE likes.BookID = books.BookID AND likes.UserID = :user_id) AS liked_by_user
                 FROM books
                 INNER JOIN users ON books.UserID = users.UserID
                 ORDER BY books.CreatedAt DESC";
    $stmtBooks = $conn->prepare($sqlBooks);
    $stmtBooks->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtBooks->execute();
    $books = $stmtBooks->fetchAll(PDO::FETCH_ASSOC);

    // Fetch comments for each book and count the number of comments
    foreach ($books as &$book) {
        $book_id = $book['BookID'];
        $sqlComments = "SELECT comments.*, users.Username, users.FullName, users.ProfilePicture 
                        FROM comments 
                        INNER JOIN users ON comments.UserID = users.UserID 
                        WHERE comments.BookID = :book_id";
        $stmtComments = $conn->prepare($sqlComments);
        $stmtComments->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        $stmtComments->execute();
        $book['comments'] = $stmtComments->fetchAll(PDO::FETCH_ASSOC);
        $book['comment_count'] = count($book['comments']);
    }
} catch (Exception $e) {
    echo '<div id="alert" class="alert alert-danger" role="alert">Error: ' . $e->getMessage() . '</div>';
}

unset($stmt);
unset($conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="./css/Cummunity.css">

    <title>Social Books Community</title>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>
        </div>
        <div class="navbar-right">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($profilePicture); ?>" class="nav-profile-img" onclick="toggleMenu()">
        </div>

        <!-- Profile Drop-down Menu -->
        <div class="profile-menu-wrap" id="profileMenu">
            <div class="profile-menu">
                <div class="user-info">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($profilePicture); ?>" alt="">
                    <div>
                        <h3><?php echo htmlspecialchars($fullname); ?></h3>
                        <a href="usersessionprofile.php">See your profile</a>
                    </div>
                </div>
                <hr>
                
                <a href="userProfile.php" class="profile-link-menu">
                    <i class="ri-settings-line"></i>
                    <p>Setting & Privacy</p>
                    <span>></span>
                </a>
                
                <a href="#" class="profile-link-menu">
                    <i class="ri-contrast-2-fill"></i>
                    <p>Display</p>
                    <span>></span>
                </a>
                <hr>
                <a href="../logout.php" class="profile-link-menu">
                    <i class="ri-logout-circle-r-line"></i>
                    <p>Log out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </nav>




    <div class="container">
        <div class="left-sidebar">
            <div class="sidebar-profile-box" style="margin-top: 4rem;">
                <div class="sidebar-profile-info">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($profilePicture); ?>" alt="User Avatar">
                    <h1><?php echo htmlspecialchars($fullname); ?></h1>
                    <h3>@<?php echo htmlspecialchars($username); ?></h3>
                    <ul>
                        <li>Books Shared <span><?php echo $booksShared; ?></span></li>
                        <li>Books Read <span><?php echo $booksRead; ?></span></li>
                    </ul>
                </div>
                <div class="sidebar-profile-link">
                    <a href="profile.php"><i class="ri-save-line"></i> My Books</a>
                    <a href="share_books.php"><i class="ri-upload-cloud-2-line"></i> Upload</a>
                </div>
            </div>
        </div>

        <div class="main-content">
            

            <!-- Sample Posts -->
            <?php foreach ($books as $book) : ?>
                <div class="post" data-book-id="<?php echo $book['BookID']; ?>">
                    <div class="post-author">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($book['ProfilePicture']); ?>" alt="">
                        <div>
                            <h1><?php echo htmlspecialchars($book['FullName']); ?></h1>
                            <small>@<?php echo htmlspecialchars($book['Username']); ?></small>
                            <small><?php echo htmlspecialchars($book['CreatedAt']); ?></small>
                        </div>
                    </div>
                    <p><?php echo htmlspecialchars($book['Description']); ?></p>
                    <div class="popular__card" role="group" aria-label="NaN / 3">
                        <img src="data:image/jpeg;base64,<?= base64_encode($book['CoverImage']) ?>" alt="Book cover" class="popular__img">
                        <div>
                            <h2 class="popular__title"><?php echo htmlspecialchars($book['Title']); ?></h2>
                            <div class="popular__prices">
                                <span class="popular__author"><?php echo htmlspecialchars($book['Author']); ?></span>
                            </div>
                            <div class="popular__stars">
                                <?php echo htmlspecialchars($book['Rating']); ?> <i class="ri-star-fill"></i>
                            </div>
                    
                        </div>
                    </div>
                    <!-- Post content -->
                    <div class="post-stats">
                        <div>
                            <span class="linked-user"><?php echo $book['like_count']; ?> Likes</span> <!-- Replace with your actual user count logic -->
                        </div>
                        <div>
                            <span><?php echo $book['comment_count']; ?> Comments</span>
                        </div>
                    </div>
                    <div class="post-activity">
                        <form id="likeForm-<?php echo $book['BookID']; ?>" class="like-form">
                            <input type="hidden" name="book_id" value="<?php echo $book['BookID']; ?>">
                            <button type="button" class="post-activity-link like-button">
                                <i class="ri-thumb-up-line"></i>
                                <?php echo $book['liked_by_user'] ? 'Unlike' : 'Like'; ?>
                            </button>
                        </form>
                        <div class="post-activity-link" onclick="toggleComments(this)">
                            <i class="ri-question-answer-line"></i>
                            <span>Comments</span>
                        </div>
                    </div>
                    <!-- Comments Section -->
                    <div class="comments-section" style="display: none;">
                        <?php foreach ($book['comments'] as $comment) : ?>
                            <div class="comment">
                                <div class="comment-author">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['ProfilePicture']); ?>" alt="">
                                    <div>
                                        <h3><?php echo htmlspecialchars($comment['FullName']); ?></h3>
                                        <small>@<?php echo htmlspecialchars($comment['Username']); ?></small>
                                    </div>
                                </div>
                                <p><?php echo htmlspecialchars($comment['Comment']); ?></p>
                            </div>
                        <?php endforeach; ?>
                        <!-- Add Comment Form -->
                        <div class="add-comment">
                            <form action="" method="post">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($profilePicture); ?>" alt="">
                                <textarea name="comment" placeholder="Write a comment"></textarea>
                                <input type="hidden" name="book_id" value="<?php echo $book['BookID']; ?>">
                                <button type="submit">Post</button>
                            </form>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            <!-- Placeholder for additional posts -->
        </div>

        <!-- Right Sidebar with Search -->
        <div class="right-sidebar">
            <div class="search-container">
                <h3>Search</h3>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Search for someone" onkeyup="searchUsers()">
                    <i class="ri-search-line"></i>
                </div>
                <div class="search-result" id="searchResult">
                    <?php foreach ($users as $user) : ?>
                        <div class="search-result-item">
                            <a href="profileCommunity.php?user_id=<?php echo $user['UserID']; ?>">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($user['ProfilePicture']); ?>" alt="Profile Image">
                                <div>
                                    <h4><?php echo htmlspecialchars($user['FullName']); ?></h4>
                                    <p>@<?php echo htmlspecialchars($user['Username']); ?></p>
                                </div>
                            </a>
                            <button class="follow-btn">Follow</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Search and Profile Menu Functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function searchUsers() {
            let input, filter, searchResult, searchItems, name, i;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            searchResult = document.getElementById('searchResult');
            searchItems = searchResult.getElementsByClassName('search-result-item');

            for (i = 0; i < searchItems.length; i++) {
                name = searchItems[i].getElementsByTagName('h4')[0];
                if (name.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    searchItems[i].style.display = '';
                } else {
                    searchItems[i].style.display = 'none';
                }
            }
        }

        function toggleComments(element) {
            const commentsSection = element.closest('.post').querySelector('.comments-section');
            commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
        }

        function toggleMenu() {
            let profileMenu = document.getElementById('profileMenu');
            profileMenu.classList.toggle('open-menu');
        }

        // Close the profile menu if the user clicks outside of it
        window.onclick = function(event) {
            let profileMenu = document.getElementById('profileMenu');
            if (!event.target.matches('.nav-profile-img') && profileMenu.classList.contains('open-menu')) {
                profileMenu.classList.remove('open-menu');
            }
        }


        $(document).ready(function() {
            $('.like-button').click(function() {
                var bookId = $(this).closest('form').find('input[name="book_id"]').val();
                var $button = $(this);

                $.ajax({
                    url: 'like_post.php',
                    type: 'POST',
                    data: {
                        book_id: bookId
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            var $likeCountElement = $button.closest('.post').find('.post-stats .linked-user');
                            $likeCountElement.text(data.new_like_count + ' Likes');

                            // Update button text
                            $button.html(data.liked ? '<i class="ri-thumb-up-fill"></i> Unlike' : '<i class="ri-thumb-up-line"></i> Like');
                        } else {
                            alert('Error liking post');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Error liking post');
                    }
                });
            });
        });
    </script>

</body>

</html>