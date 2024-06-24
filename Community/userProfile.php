<?php
require '../config.php'; // Adjust the path as per your file structure

// Initialize variables for user data
$username = '';
$fullname = '';
$email = '';
$bio = '';
$birthday = '';
$userImage = ''; // Initialize variable for storing user image

// PHP script to handle form submission and display user information
$alertMessage = ''; // Variable to store alert messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assuming you have a logged-in user with a session
    session_start();
    $user_id = $_SESSION['UserID']; // You should already have the user_id stored in the session

    // Retrieve form data
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $birthday = $_POST['birthday'];

    try {
        // SQL query to update user information
        $sql = "UPDATE users SET Username = :username, FullName = :fullname, Email = :email, Bio = :bio, Birthday = :birthday WHERE UserID = :user_id";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':user_id', $user_id);

        // Execute the update statement
        if ($stmt->execute()) {
            $alertMessage = '<div id="alert" class="alert alert-success" role="alert">Record updated successfully</div>';
        } else {
            $alertMessage = '<div id="alert" class="alert alert-danger" role="alert">Error updating record: ' . $stmt->errorInfo()[2] . '</div>';
        }
    } catch (PDOException $e) {
        $alertMessage = '<div id="alert" class="alert alert-danger" role="alert">Error updating record: ' . $e->getMessage() . '</div>';
    }

    // Close statement and database connection
    unset($stmt); // Unset the statement object
    unset($pdo); // Unset the PDO object
} else {
    // If not a POST request (initial load), fetch user information
    session_start();
    $user_id = $_SESSION['UserID']; // You should already have the user_id stored in the session

    try {
        // SQL query to fetch user information
        $sql = "SELECT Username, FullName, Email, Bio, Birthday, ProfilePicture FROM users WHERE UserID = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch user details
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $username = $row['Username'];
            $fullname = $row['FullName'];
            $email = $row['Email'];
            $bio = $row['Bio'];
            $birthday = $row['Birthday'];
            // Assuming ProfilePicture is stored as binary data in the database (blob)
            $userImage = $row['ProfilePicture']; // Fetch user image from database
        } else {
            $alertMessage = '<div id="alert" class="alert alert-danger" role="alert">User not found</div>';
        }
    } catch (PDOException $e) {
        $alertMessage = '<div id="alert" class="alert alert-danger" role="alert">Error fetching user information: ' . $e->getMessage() . '</div>';
    }

    // Close statement and database connection
    unset($stmt); // Unset the statement object
    unset($pdo); // Unset the PDO object
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialBook's | Profile Template</title>
    <link rel="stylesheet" href="./css/UserProfileStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class="ri-book-3-line"></i> <span class="logo_name">SocialBook's</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="Community.php">
                    <i class="ri-community-line"></i>
                    <span class="linkname">Community</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="linkname" href="#">Community</a></li>
                </ul>
            </li>
            <li>
                <a href="profile.php">
                    <i class="ri-bookmark-line"></i>
                    <span class="linkname">Saved Books</span>
                </a>
                <ul class="sub-menu blank">
                    <li>
                        <a class="linkname" href="#">Saved Books</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="upload.php">
                    <i class="ri-upload-line"></i>
                    <span class="linkname">Upload a Book</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="linkname" href="#">Upload a Book</a></li>
                </ul>
            </li>
            <li>
                <a href="userProfile.php">
                    <i class="ri-user-line"></i>
                    <span class="linkname">User Information</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="linkname" href="#">User Information</a></li>
                </ul>
            </li>
            <li>
                <a href="../logout.php">
                    <i class="ri-logout-circle-line"></i></i>
                    <span class="linkname">Log out</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="linkname" href="#">User Information</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="container light-style flex-grow-1 container-p-y">
        <?php echo $alertMessage; ?>
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($userImage); ?>" alt="User Avatar" class="d-block ui-w-80">
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <form action="userProfile.php" method="POST">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                                    </div>
                            </div>
                            <hr class="border-light m-0">
                            </form>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <form action="changePassword.php" method="POST">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" class="form-control" name="confirm_password">
                                    </div>
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <form action="userProfile.php" method="POST">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bio</label>
                                        <textarea class="form-control" rows="5" name="bio"><?php echo htmlspecialchars($bio); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Birthday</label>
                                        <input type="date" class="form-control" name="birthday" value="<?php echo htmlspecialchars($birthday); ?>">
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                        <button type="reset" class="btn btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    $("#alert").fadeOut("slow", function() {
                        $(this).remove();
                    });
                }, 2000);
            });
        </script>
</body>

</html>