<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

require '../config.php';

// Fetch session user data
$session_user_id = $_SESSION['UserID'];
$sqlSessionUser = "SELECT * FROM users WHERE UserID = :session_user_id";
$stmtSessionUser = $conn->prepare($sqlSessionUser);
$stmtSessionUser->bindParam(':session_user_id', $session_user_id, PDO::PARAM_INT);
$stmtSessionUser->execute();
$userSession = $stmtSessionUser->fetch(PDO::FETCH_ASSOC);

// Fetch books read by the session user
$sqlBooksRead = "SELECT * FROM saved_books WHERE UserID = :session_user_id AND ReadingStatus = 'read'";
$stmtBooksRead = $conn->prepare($sqlBooksRead);
$stmtBooksRead->bindParam(':session_user_id', $session_user_id, PDO::PARAM_INT);
$stmtBooksRead->execute();
$booksRead = $stmtBooksRead->fetchAll(PDO::FETCH_ASSOC);

// Fetch books shared by the session user with like count and user liking status
$sqlBooksShared = " SELECT b.*, u.*
    FROM books b
    INNER JOIN users u ON b.UserID = u.UserID
    WHERE b.UserID = :session_user_id
    ORDER BY b.CreatedAt DESC
";

$stmtBooksShared = $conn->prepare($sqlBooksShared);
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
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="./css/Cummunity.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <!-- Profile Menu -->
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
                <a href="#" class="profile-link-menu">
                    <i class="ri-logout-circle-r-line"></i>
                    <p>Log out</p>
                    <span>></span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 4rem;flex-direction: row-reverse;">
        <div class="profile-main">
            <div class="profile-container" style="width: 550px;">
                <img src="" alt="" width="100%">
                <div class="profile-container-inner">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($userSession['ProfilePicture']); ?>" alt="Profile Image" class="profile-pic">
                    <h1><?php echo htmlspecialchars($userSession['FullName']); ?></h1>
                    <b>@<?php echo htmlspecialchars($userSession['Username']); ?></b>
                    <p><?php echo htmlspecialchars($userSession['Bio']); ?></p>

                </div>
            </div>
            <div class="profile-description" style="width: 550px;">
                <h2>Books Read</h2>
                <?php foreach ($booksRead as $book) : ?>
                    <div class="popular__card" style="margin: 0;">
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
                <!-- Displaying each book post shared by the user -->
                <?php foreach ($booksShared as $book) : ?>
                    <div class="post" data-book-id="<?php echo $book['BookID']; ?>" style="width: 550px;">
                        <div class="post-author">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($book['ProfilePicture'] ?? ''); ?>" alt="">
                            <div>
                                <h1><?php echo htmlspecialchars($book['FullName'] ?? ''); ?></h1>
                                <small>@<?php echo htmlspecialchars($book['Username'] ?? ''); ?></small>
                                <small><?php echo htmlspecialchars($book['CreatedAt'] ?? ''); ?></small>
                            </div>
                        </div>
                        <!-- Other content -->
                        <div class="popular__card">
                            <img src="data:image/jpeg;base64,<?= base64_encode($book['CoverImage'] ?? '') ?>" alt="Book cover" class="popular__img">
                            <div>
                                <h2 class="popular__title"><?php echo htmlspecialchars($book['Title'] ?? ''); ?></h2>
                                <div class="popular__prices">
                                    <span class="popular__author"><?php echo htmlspecialchars($book['Author'] ?? ''); ?></span>
                                </div>
                                <div class="popular__stars">
                                    <?php echo htmlspecialchars($book['Rating'] ?? ''); ?> <i class="ri-star-fill"></i>
                                </div>
                                <div>
                                    <a href="./detailsPage.php?id=<?php echo urlencode($book['BookID']); ?>" class="PopularButton">Details</a>
                                </div>
                            </div>
                        </div>
                        <!-- Post stats -->
                        <div class="post-stats">
                            <div>
                                <span class="linked-user"><?php echo isset($book['like_count']) ? $book['like_count'] : '0'; ?> Likes</span>
                            </div>
                            <div>
                                <span><?php echo isset($book['comment_count']) ? $book['comment_count'] : '0'; ?> Comments</span>
                            </div>
                        </div>
                        <!-- Post activity -->
                        <div class="post-activity">
                            <form id="likeForm-<?php echo $book['BookID']; ?>" class="like-form">
                                <input type="hidden" name="book_id" value="<?php echo $book['BookID']; ?>">
                                <button type="button" class="post-activity-link like-button">
                                    <i class="ri-thumb-up-line"></i>
                                    <?php echo isset($book['liked_by_user']) && $book['liked_by_user'] ? 'Unlike' : 'Like'; ?>
                                </button>
                            </form>
                            <!-- Comments toggle -->
                            <div class="post-activity-link" onclick="toggleComments(this)">
                                <i class="ri-question-answer-line"></i>
                                <span>Comments</span>
                            </div>
                        </div>

                        <!-- Comments section -->
                        <div class="comments-section" style="display: none;">
                            <?php foreach ($book['comments'] ?? [] as $comment) : ?>
                                <div class="comment">
                                    <div class="comment-author">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($comment['ProfilePicture'] ?? ''); ?>" alt="">
                                        <div>
                                            <h3><?php echo htmlspecialchars($comment['FullName'] ?? ''); ?></h3>
                                            <small>@<?php echo htmlspecialchars($comment['Username'] ?? ''); ?></small>
                                        </div>
                                    </div>
                                    <p><?php echo htmlspecialchars($comment['Comment'] ?? ''); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Add comment form -->
                        <div class="add-comment">
                            <form class="comment-form">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($userSession['ProfilePicture'] ?? ''); ?>" alt="Profile Picture">
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
            $('.comment-form').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                var $form = $(this);
                var $commentsSection = $form.closest('.post').find('.comments-section');

                $.ajax({
                    url: 'comments.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
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
                            $commentsSection.append(commentHtml);
                            $form.find('textarea').val('');
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