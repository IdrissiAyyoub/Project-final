<?php
session_start();
require '../config.php'; // Adjust the path as needed

// Check and create the uploads directory
$uploadDirectory = 'uploads';

if (!is_dir($uploadDirectory)) {
    if (!mkdir($uploadDirectory, 0777, true)) {
        // Handle error if directory creation fails
        echo "Failed to create directory '$uploadDirectory'";
        exit();
    }
}

// Continue with your existing PHP script
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['registration'])) {
        // Redirect to the first step if no session data found
        header("Location: login.php");
        exit();
    }

    $username = $_POST['username'];
    $bio = $_POST['bio'];
    $birthday = $_POST['birthday'];
    $genre = $_POST['genre'];
    $books_interests = $_POST['books_interests'];

    // Upload profile picture
    $profilePicture = NULL;
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profilePicture = $target_file;
        } else {
            echo "Failed to upload profile picture.";
            exit();
        }
    }

    // Retrieve the data from the session
    $fullname = $_SESSION['registration']['FullName'];
    $email = $_SESSION['registration']['Email'];
    $password = $_SESSION['registration']['Password'];
    $_SESSION['UserID'] = $UserID;
    // Insert the data into the database
    $sql = "INSERT INTO users (Username, FullName, Email, Password, Genre, Birthday, Bio, ProfilePicture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $fullname, $email, $password, $genre, $birthday, $bio, $profilePicture);

    if ($stmt->execute()) {
        echo "Registration successful!";

        // Set UserID session variable
        $_SESSION['UserID'] = $stmt->insert_id; // Assuming your user ID column is auto-incremented

        // Unset the session data after successful registration
        unset($_SESSION['registration']);
        header("Location: ../IndexPage.php"); // Redirect to index.php
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">

    <!---Custom CSS File--->
    <link rel="stylesheet" href="registration.css" />
    <style>
        .book-item {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .delete-icon {
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
</head>

<body>

    <section class="container">
        <div class="logo">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>
        </div>
        <header>More informations</header>
        <!-- Additional Information Form -->
        <form action="" method="post" enctype="multipart/form-data" class="form">
            <div class="input-box">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required />
            </div>
            <div class="input-box">
                <label>Bio</label>
                <input type="text" name="bio" placeholder="Enter your bio">
            </div>
            <div class="input-box">
                <label>Birthday</label>
                <input type="date" name="birthday" placeholder="Enter birthday" required />
            </div>

            <div class="gender-box">
                <h3>Genre</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="genre" value="male" checked />
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="genre" value="female" />
                        <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-other" name="genre" value="other" />
                        <label for="check-other">Prefer not to say</label>
                    </div>
                </div>
            </div>

            <div class="input-box">
                <label>Profile Picture</label>
                <input type="file" name="profile_picture" accept="image/*" required />
            </div>

            <div class="input-box">
                <label>Books Interests</label>
                <input type="text" name="books_interests" id="books-interests" placeholder="Search for books interests" required />
                <div id="entered-text"></div>
                <div id="books-list"></div>
            </div>

            <button type="submit">Submit</button>
        </form>

    </section>

    <!-- Custom JavaScript -->
    <script>
        document.getElementById('books-interests').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent form submission
                var enteredText = this.value.trim();
                if (enteredText !== '') {
                    var enteredTextElement = document.getElementById('entered-text');
                    enteredTextElement.textContent = 'Last one you enter :' + enteredText;
                    this.value = ''; // Clear the input field

                    // Create book element
                    var bookElement = document.createElement('div');
                    bookElement.classList.add('book-item');
                    bookElement.innerHTML = `
                        <span>${enteredText}</span>
                        <i class="ri-close-circle-line delete-icon" data-book="${enteredText}"></i>
                    `;
                    document.getElementById('books-list').appendChild(bookElement);

                    // Attach event listener to delete icon
                    var deleteIcons = document.querySelectorAll('.delete-icon');
                    deleteIcons.forEach(function(icon) {
                        icon.addEventListener('click', function() {
                            var bookToRemove = this.getAttribute('data-book');
                            var bookToRemoveElement = document.querySelector(`[data-book="${bookToRemove}"]`);
                            if (bookToRemoveElement) {
                                bookToRemoveElement.parentElement.remove();
                            }
                        });
                    });
                }
            }
        });
    </script>
</body>

</html>