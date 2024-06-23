<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

require '../config.php';

// Get the user_id from the URL (for displaying user's profile)
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Fetch user data for the profile being viewed
$sqlUser = "SELECT * FROM users WHERE UserID = :user_id";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtUser->execute();
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Fetch session user data
$session_user_id = $_SESSION['UserID'];
$sqlSessionUser = "SELECT * FROM users WHERE UserID = :session_user_id";
$stmtSessionUser = $conn->prepare($sqlSessionUser);
$stmtSessionUser->bindParam(':session_user_id', $session_user_id, PDO::PARAM_INT);
$stmtSessionUser->execute();
$userSession = $stmtSessionUser->fetch(PDO::FETCH_ASSOC);

// Fetch books read by the user
$sqlBooksRead = "SELECT * FROM saved_books WHERE UserID = :user_id AND ReadingStatus = 'read'";
$stmtBooksRead = $conn->prepare($sqlBooksRead);
$stmtBooksRead->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtBooksRead->execute();
$booksRead = $stmtBooksRead->fetchAll(PDO::FETCH_ASSOC);

// Fetch books shared by the user sorted by creation time (latest first) with like count and user liking status
$sqlBooksShared = "SELECT b.*, u.Username, u.FullName, u.ProfilePicture,
                        (SELECT COUNT(*) FROM likes WHERE BookID = b.BookID) AS like_count,
                        (SELECT COUNT(*) FROM likes WHERE BookID = b.BookID AND UserID = :session_user_id) AS liked_by_user
                  FROM books b
                  INNER JOIN users u ON b.UserID = u.UserID
                  WHERE b.UserID = :user_id
                  ORDER BY b.CreatedAt DESC";
$stmtBooksShared = $conn->prepare($sqlBooksShared);
$stmtBooksShared->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtBooksShared->bindParam(':session_user_id', $session_user_id, PDO::PARAM_INT);
$stmtBooksShared->execute();
$booksShared = $stmtBooksShared->fetchAll(PDO::FETCH_ASSOC);

// Fetch comments for each book and count the number of comments
foreach ($booksShared as &$book) {
    $book_id = $book['BookID'];
    $sqlComments = "SELECT c.*, u.Username, u.FullName, u.ProfilePicture 
                    FROM comments c
                    INNER JOIN users u ON c.UserID = u.UserID 
                    WHERE c.BookID = :book_id";
    $stmtComments = $conn->prepare($sqlComments);
    $stmtComments->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmtComments->execute();
    $book['comments'] = $stmtComments->fetchAll(PDO::FETCH_ASSOC);
    $book['comment_count'] = count($book['comments']);
}


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>User Profile</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>
        </div>

        <div class="navbar-right">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($userSession['ProfilePicture']); ?>" class="nav-profile-img" onclick="toggleMenu()">
        </div>
        <!-- -------------------- Profile-drop -----------------------  -->

        <div class="profile-menu-wrap" id="profileMenu">
            <div class="profile-menu">
                <div class="user-info">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($userSession['ProfilePicture']); ?>" alt="Profile Image">
                    <div>
                        <h3><?php echo htmlspecialchars($userSession['FullName']); ?></h3>
                        <a href="../Community/userProfile.php">See your profile</a>
                    </div>
                </div>
                <hr>
                <a href="" class="profile-link-menu">
                    <i class="ri-feedback-fill"></i>
                    <p>Give Feedback</p>
                    <span>></span>
                </a>
                <a href="" class="profile-link-menu">
                    <i class="ri-settings-line"></i>
                    <p>Setting & Privacy</p>
                    <span>></span>
                </a>
                <a href="" class="profile-link-menu">
                    <i class="ri-questionnaire-fill"></i>
                    <p>Help & Support</p>
                    <span>></span>
                </a>

                <a href="" class="profile-link-menu">
                    <i class="ri-contrast-2-fill"></i>
                    <p>Display</p>
                    <span>></span>
                </a>
                <hr>
                <a href="" class="profile-link-menu">
                    <i class="ri-logout-circle-r-line"></i>
                    <p>Log out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="profile-main">
            <div class="profile-container">
                <img src="" alt="" width="100%">
                <div class="profile-container-inner">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['ProfilePicture']); ?>" alt="Profile Image" class="profile-pic">
                    <h1><?php echo htmlspecialchars($user['FullName']); ?></h1>
                    <b>@<?php echo htmlspecialchars($user['Username']); ?></b>
                    <p><?php echo htmlspecialchars($user['Bio']); ?></p>
                    <div class="profile-btn">
                        <a href=""><i class="ri-user-add-fill"></i>Follow</a>
                    </div>
                </div>
            </div>
            <div class="profile-description">
                <h2>Books Read</h2>
                <?php foreach ($booksRead as $book) : ?>
                    <div class="popular__card" style="margin: 0">
                        <img src="data:image/jpeg;base64,<?= base64_encode($book['CoverImage']) ?>" alt="Cover Image" class="popular__img">
                        <div>
                            <h1 class="popular__title"><?php echo htmlspecialchars($book['BookTitle']); ?></h1>
                            <span class="popular__author"><?php echo htmlspecialchars($book['AuthorName']); ?></span>
                            <p class="popular__goal"><?php echo htmlspecialchars($book['Description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="main-content">
                <div class="sort-by">
                    <hr>
                </div>

                <!-- Displaying each book post shared by the user -->
                <?php foreach ($booksShared as $book) : ?>
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
                                <div>
                                    <a href="./detailsPage.php?id=<?php echo urlencode($book['BookID']); ?>" class="PopularButton">Details</a>
                                </div>
                            </div>
                        </div>
                        <!-- Post content -->
                        <div class="post-stats">
                            <div>
                                <span class="linked-user"><?php echo $book['like_count']; ?> Likes</span>
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

                        <!-- Inside the foreach loop for displaying each book post -->
                        <div class="comments-section">
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
                        </div>

                        <!-- Add Comment Form -->
                        <div class="add-comment">
                            <form class="comment-form">
                                <!-- Display session user's profile picture -->
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($userSession['ProfilePicture']); ?>" alt="Profile Picture">
                                <textarea name="comment" placeholder="Write a comment"></textarea>
                                <input type="hidden" name="book_id" value="<?php echo $book['BookID']; ?>">
                                <button type="submit">Post</button>
                            </form>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        let profileMenu = document.getElementById('profileMenu');

        function toggleMenu() {
            profileMenu.classList.toggle('open-menu')
        }

        function toggleComments(element) {
            const commentsSection = element.closest('.post').querySelector('.comments-section');
            commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
        }
        $(document).ready(function() {
            $('.comment-form').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: 'profileCommunity.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        // Handle success response as needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error response as needed
                    }
                });
            });
        });
        $(document).ready(function() {
            // Submit comment form via AJAX
            $('.comment-form').submit(function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: 'process_comment.php', // Adjust the URL as per your server setup
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            // Clear the textarea
                            $('.comment-form textarea').val('');

                            // Append new comment to comments section
                            var commentHtml = `
                        <div class="comment">
                            <div class="comment-author">
                                <img src="data:image/jpeg;base64,${data.comment.ProfilePicture}" alt="">
                                <div>
                                    <h3>${data.comment.FullName}</h3>
                                    <small>@${data.comment.Username}</small>
                                </div>
                            </div>
                            <p>${data.comment.Comment}</p>
                        </div>
                    `;
                            $('.comments-section').append(commentHtml);
                        } else {
                            alert('Failed to add comment.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Error adding comment.');
                    }
                });
            });
        });

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