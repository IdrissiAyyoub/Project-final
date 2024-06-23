<?php
session_start();
require '../config.php';

// Check if all required POST data is received
if (!isset($_POST['comment']) || !isset($_POST['book_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
    exit;
}

// Sanitize and validate inputs
$comment = trim($_POST['comment']);
$book_id = intval($_POST['book_id']);
$user_id = $_SESSION['UserID'];

if (empty($comment)) {
    echo json_encode(['success' => false, 'message' => 'Comment cannot be empty']);
    exit;
}

try {
    // Insert comment into database
    $sqlInsertComment = "INSERT INTO comments (UserID, BookID, Comment, CreatedAt) 
                         VALUES (:user_id, :book_id, :comment, CURRENT_TIMESTAMP)";
    $stmtInsertComment = $conn->prepare($sqlInsertComment);
    $stmtInsertComment->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtInsertComment->bindParam(':book_id', $book_id, PDO::PARAM_INT);
    $stmtInsertComment->bindParam(':comment', $comment, PDO::PARAM_STR);

    if ($stmtInsertComment->execute()) {
        // Fetch inserted comment data
        $sqlFetchComment = "SELECT c.*, u.Username, u.FullName, u.ProfilePicture 
                            FROM comments c
                            INNER JOIN users u ON c.UserID = u.UserID 
                            WHERE c.CommentID = LAST_INSERT_ID()";
        $stmtFetchComment = $conn->prepare($sqlFetchComment);
        $stmtFetchComment->execute();
        $newComment = $stmtFetchComment->fetch(PDO::FETCH_ASSOC);

        // Return success response with new comment data
        echo json_encode(['success' => true, 'comment' => $newComment]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to insert comment']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Unexpected error: ' . $e->getMessage()]);
}
