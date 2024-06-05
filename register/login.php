<?php
session_start();
require '../config.php';

// Handling user registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Store the data in the session
  $_SESSION['registration'] = [
    'FullName' => $fullname,
    'Email' => $email,
    'Password' => $password
  ];

  // Redirect to the second step or perform additional validation if needed
  header("Location: registration.php");
  exit();
}

// Handling user login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare and bind
  $stmt = $conn->prepare("SELECT UserID, FullName, Password FROM users WHERE Email = ?");
  $stmt->bind_param("s", $email);

  // Execute the statement
  $stmt->execute();

  // Bind result variables
  $stmt->bind_result($UserID, $FullName, $hashed_password);

  // Fetch value
  if ($stmt->fetch()) {
    // Verify password
    if (password_verify($password, $hashed_password)) {
      // Store user information in session
      $_SESSION['UserID'] = $UserID;
      $_SESSION['FullName'] = $FullName;
      $_SESSION['Email'] = $email;

      // Redirect to a logged-in page (e.g., dashboard)
      header("Location: ../IndexPage.php");
      exit();
    } else {
      $login_error = "Invalid password.";
    }
  } else {
    $login_error = "No user found with that email address.";
  }

  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in & Sign up Form</title>
  <!-- Styles -->
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <main>
    <div class="box">
      <div class="inner-box">
        <div class="forms-wrap">
          <!-- Login Form -->
          <form action="" method="post" autocomplete="off" class="sign-in-form">
            <div class="logo">
              <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
              </a>
            </div>

            <div class="heading">
              <h2>Welcome Back</h2>
              <h6>Not registered yet?</h6>
              <a href="#" class="toggle">Sign up</a>
            </div>

            <div class="actual-form">
              <div class="input-wrap">
                <input type="email" name="email" class="input-field" autocomplete="off" required>
                <label>Email</label>
              </div>

              <div class="input-wrap">
                <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required>
                <label>Password</label>
              </div>

              <input type="hidden" name="login" value="1">

              <input type="submit" value="Sign In" class="sign-btn">

              <p class="text">
                Forgotten your password or your login details?
                <a href="#">Get help</a> signing in
              </p>
            </div>
          </form>

          <!-- Registration Form -->
          <form action="" method="post" autocomplete="off" class="sign-up-form">
            <div class="logo">
              <a href="#" class="nav__logo">
                <i class="ri-book-3-line"></i> SocialBook's
              </a>
            </div>

            <div class="heading">
              <h2>Get Started</h2>
              <h6>Already have an account?</h6>
              <a href="#" class="toggle">Sign in</a>
            </div>

            <div class="actual-form">
              <div class="input-wrap">
                <input type="text" name="fullname" minlength="4" class="input-field" autocomplete="off" required>
                <label>Full Name</label>
              </div>

              <div class="input-wrap">
                <input type="email" name="email" class="input-field" autocomplete="off" required>
                <label>Email</label>
              </div>

              <div class="input-wrap">
                <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required>
                <label>Password</label>
              </div>

              <input type="hidden" name="register" value="1">

              <input type="submit" value="Sign Up" class="sign-btn">

              <p class="text">
                By signing up, I agree to the
                <a href="#">Terms of Services</a> and
                <a href="#">Privacy Policy</a>
              </p>
            </div>
          </form>
        </div>

        <div class="carousel">
          <div class="images-wrapper">
            <img src="./img/image1.png" class="image img-1 show" alt="">
            <img src="./img/image2.png" class="image img-2" alt="">
            <img src="./img/image3.png" class="image img-3" alt="">
          </div>

          <div class="text-slider">
            <div class="text-wrap">
              <div class="text-group">
                <h2>Discover the wonderful world of books</h2>
                <h2>Customize as you like</h2>
                <h2>Invite students to your class</h2>
              </div>
            </div>

            <div class="bullets">
              <span class="active" data-value="1"></span>
              <span data-value="2"></span>
              <span data-value="3"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Javascript file -->
  <script src="app.js"></script>
</body>

</html>