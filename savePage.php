<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (!isset($_SESSION['UserID'])) {
        echo json_encode(["success" => false, "message" => "User not logged in."]);
        exit;
    }

    // Validate form data
    if (empty($_POST['bookID']) || empty($_POST['readingStatus'])) {
        echo json_encode(["success" => false, "message" => "Incomplete form data."]);
        exit;
    }

    // Sanitize input data
    $bookID = $_POST['bookID'];
    $readingStatus = $_POST['readingStatus'];

    // Prepare and execute SQL statement
    $sql = "INSERT INTO saved_books (UserID, BookID, ReadingStatus) VALUES (?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("iis", $_SESSION['UserID'], $bookID, $readingStatus);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error executing statement: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Error preparing statement: " . $mysqli->error]);
    }

    // Close database connection
    $mysqli->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
