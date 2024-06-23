<?php
session_start();
require_once '../config.php';

// Handling user registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Hash the password
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);


  // Store the data in the session
  $_SESSION['registration'] = [
    'FullName' => $fullname,
    'Email' => $email,
    'Password' => $password_hashed
  ];

  // Redirect to the second step or perform additional validation if needed
  header("Location: registration.php");
  exit();
}

// Handling user login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Prepare statement for selection
  $stmt = $conn->prepare("SELECT UserID, FullName, Password FROM users WHERE Email = :email");
  $stmt->bindParam(':email', $email);

  // Execute the statement
  $stmt->execute();

  // Fetch result
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    // Verify password
    if (password_verify($password, $user['Password'])) {
      // Store user information in session
      $_SESSION['UserID'] = $user['UserID'];
      $_SESSION['FullName'] = $user['FullName'];
      $_SESSION['Email'] = $email;

      // Redirect to a logged-in page (e.g., dashboard)
      header("Location: ../IndexPage.php");
      exit();
    } else {
      $login_errors['password'] = "Invalid password.";
    }
  } else {
    $login_errors['email'] = "No user found with that email address.";
  }
}

// Close the database connection
$conn = null;
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
          <form action="" method="post" autocomplete="off" class="sign-in-form" id="loginForm">
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
                <input type="email" name="email" id="loginEmail" class="input-field" autocomplete="off">
                <label>Email</label>
              </div>
              <span id="loginEmailError" class="error"></span>


              <div class="input-wrap">
                <input type="password" name="password" id="loginPassword" minlength="4" class="input-field" autocomplete="off">
                <label>Password</label>
              </div>
              <span id="loginPasswordError" class="error"></span>


              <input type="hidden" name="login" value="1">

              <input type="submit" value="Sign In" class="sign-btn">

              <p class="text">
                Forgotten your password or your login details?
                <a href="#">Get help</a> signing in
              </p>
            </div>
          </form>

          <!-- Registration Form -->
          <form action="" method="post" autocomplete="off" class="sign-up-form" id="registerForm">
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
                <input type="text" name="fullname" id="registerFullName" minlength="4" class="input-field" autocomplete="off">
                <label>Full Name</label>
              </div>
              <span id="registerFullNameError" class="error"></span>


              <div class="input-wrap">
                <input type="email" name="email" id="registerEmail" class="input-field" autocomplete="off">
                <label>Email</label>
              </div>
              <span id="registerEmailError" class="error"></span>


              <div class="input-wrap">
                <input type="password" name="password" id="registerPassword" minlength="4" class="input-field" autocomplete="off">
                <label>Password</label>
              </div>
              <span id="registerPasswordError" class="error"></span>


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
  <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
      var email = document.getElementById("loginEmail").value;
      var password = document.getElementById("loginPassword").value;
      var emailError = document.getElementById("loginEmailError");
      var passwordError = document.getElementById("loginPasswordError");
      emailError.textContent = "";
      passwordError.textContent = "";

      if (!email) {
        emailError.textContent = "Email is required";
        event.preventDefault();
      }
      if (!password) {
        passwordError.textContent = "Password is required";
        event.preventDefault();
      }
    });

    document.getElementById("registerForm").addEventListener("submit", function(event) {
      var fullName = document.getElementById("registerFullName").value;
      var email = document.getElementById("registerEmail").value;
      var password = document.getElementById("registerPassword").value;
      var fullNameError = document.getElementById("registerFullNameError");
      var emailError = document.getElementById("registerEmailError");
      var passwordError = document.getElementById("registerPasswordError");
      fullNameError.textContent = "";
      emailError.textContent = "";
      passwordError.textContent = "";

      if (!fullName) {
        fullNameError.textContent = "Full name is required";
        event.preventDefault();
      }
      if (!email) {
        emailError.textContent = "Email is required";
        event.preventDefault();
      }
      if (!password) {
        passwordError.textContent = "Password is required";
        event.preventDefault();
      }
    });
  </script>
</body>

</html>