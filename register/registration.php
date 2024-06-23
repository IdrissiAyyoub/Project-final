<?php

session_start();
require '../config.php'; // Adjust the path as needed

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

    // Upload profile picture
    $profilePicture = NULL;
    if (!empty($_FILES['profile_picture']['tmp_name'])) {
        $profilePicture = file_get_contents($_FILES['profile_picture']['tmp_name']);
    }

    // Retrieve the data from the session
    $fullname = $_SESSION['registration']['FullName'];
    $email = $_SESSION['registration']['Email'];
    $password = password_hash($_SESSION['registration']['Password'], PASSWORD_DEFAULT); // Encrypt the password

    try {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT UserID FROM users WHERE Username = :username OR Email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "Username or email already exists.";
            exit();
        }

        // Insert the data into the users table
        $sql = "INSERT INTO users (Username, FullName, Email, Password, Genre, Birthday, Bio, ProfilePicture) 
                VALUES (:username, :fullname, :email, :password, :genre, :birthday, :bio, :profilePicture)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':profilePicture', $profilePicture, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            // Get the last inserted user ID
            $userID = $conn->lastInsertId();

            // Set UserID session variable
            $_SESSION['UserID'] = $userID;

            // Unset the session data after successful registration
            unset($_SESSION['registration']);
            header("Location: ../IndexPage.php"); // Redirect to index.php
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="registration.css" />
</head>

<body>

    <section class="container">
        <div class="logo">
            <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
            </a>
        </div>
        <header>More informations</header>
        <form action="" method="post" enctype="multipart/form-data" class="form">
            <div class="image">
                <label for="input-file" id="drop-area">
                    <div id="img-view">
                        <i class="ri-upload-cloud-2-line"></i>
                        <p>Click here to upload image</p>
                    </div>
                    <input type="file" name="profile_picture" id="input-file" accept="image/*" required hidden>
                </label>
            </div>

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


            <button type="submit">Submit</button>
        </form>
    </section>


</body>
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

</html>