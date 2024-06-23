<?php
session_start();
require '../config.php'; // Adjust path as necessary

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Get book_id from POST data
$book_id = isset($_POST['book_id']) ? intval($_POST['book_id']) : 0;
$user_id = $_SESSION['UserID'];

// Check if the user has already liked the book
$sqlCheckLike = "SELECT COUNT(*) AS count FROM likes WHERE UserID = :user_id AND BookID = :book_id";
$stmtCheckLike = $conn->prepare($sqlCheckLike);
$stmtCheckLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtCheckLike->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$stmtCheckLike->execute();
$likeExists = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);

if ($likeExists['count'] > 0) {
    // User has already liked the book, so unlike it
    $sqlDeleteLike = "DELETE FROM likes WHERE UserID = :user_id AND BookID = :book_id";
    $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
    $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtDeleteLike->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmtDeleteLike->execute();

    $liked = false;
} else {
    // User has not liked the book, so like it
    $sqlInsertLike = "INSERT INTO likes (UserID, BookID, CreatedAt) VALUES (:user_id, :book_id, CURRENT_TIMESTAMP)";
    $stmtInsertLike = $conn->prepare($sqlInsertLike);
    $stmtInsertLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtInsertLike->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmtInsertLike->execute();

    $liked = true;
}

// Get updated like count for the book
$sqlCountLikes = "SELECT COUNT(*) AS like_count FROM likes WHERE BookID = :book_id";
$stmtCountLikes = $conn->prepare($sqlCountLikes);
$stmtCountLikes->bindParam(':book_id', $book_id, PDO::PARAM_INT);
$stmtCountLikes->execute();
$likeCount = $stmtCountLikes->fetch(PDO::FETCH_ASSOC)['like_count'];

// Return JSON response
echo json_encode(['success' => true, 'liked' => $liked, 'new_like_count' => $likeCount]);
exit();
