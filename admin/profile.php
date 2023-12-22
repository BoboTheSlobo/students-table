<?php
 include 'auth_session.php';
 require 'dbcon.php';
  $username = $_SESSION['username'];

// Fetch current user's information
$userInfoQuery = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($con, $userInfoQuery);

if (!$result) {
    die("Error fetching user information: " . mysqli_error($con));
}

$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update username
    if (isset($_POST['update_username'])) {
        $newUsername = $_POST['new_username'];

        $updateUsernameQuery = "UPDATE users SET username = '$newUsername' WHERE username = '$username'";
        mysqli_query($con, $updateUsernameQuery);

        // Update the session variable
        $_SESSION['username'] = $newUsername;

        // Redirect to profile page to reflect changes
        header("Location: profile.php");
        exit();
    }

    // Update email
    if (isset($_POST['update_email'])) {
        $newEmail = $_POST['new_email'];

        $updateEmailQuery = "UPDATE users SET email = '$newEmail' WHERE username = '$username'";
        mysqli_query($con, $updateEmailQuery);

        // Redirect to profile page to reflect changes
        header("Location: profile.php");
        exit();
    }

// Update password
if (isset($_POST['update_password'])) {
  $currentPassword = $_POST['current_password'];
  $newPassword = $_POST['new_password'];

  // Fetch the user's hashed password from the database
  $passwordQuery = "SELECT password FROM users WHERE username = '$username'";
  $passwordResult = mysqli_query($con, $passwordQuery);

  if (!$passwordResult) {
      die("Error fetching user password: " . mysqli_error($con));
  }

  $passwordRow = mysqli_fetch_assoc($passwordResult);

  // Check if the current password is correct
  if (password_verify($currentPassword, $passwordRow['password'])) {
      // Hash the new password
      $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      // Update the password in the database
      $updatePasswordQuery = "UPDATE users SET password = '$hashedNewPassword' WHERE username = '$username'";
      mysqli_query($con, $updatePasswordQuery);

      // Redirect to profile page to reflect changes
      header("Location: profile.php");
      exit();
  } else {
      // Display an error message or handle the incorrect password scenario
      echo "Incorrect current password";
  }
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css./style.css"/>
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <title>Profile </title>
      </head>
<body>
<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand me-5 text-white " href="#"><h2 class="fw-bold">Internship Students</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav   mb-2 mb-lg-0 d-flex align-items-lg-center navbar_links_container">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white text-white" href="students.php">Students</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#services" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu bg-primary">
            <li><a class="dropdown-item text-white" href="#first-service">Blog</a></li>
            <li><a class="dropdown-item text-white" href="#second-service">Contact</a></li>
          </ul>
        </li>
        <li class="nav-item ms-lg-3">
        <form class="form-inline">
    <div class="input-group">
      <input type="text" class="form-control rounded  outline-0 " placeholder="Search by Name" aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary bg-white border-0 rounded-end ms-1 pt-2 pb-2" type="button">
          <i class="bi bi-search text-primary"></i>
          </button>
      </div>
    </div>
  </form>
       </li>
       <li class="nav-item ms-lg-auto">
         <div class="align-items-center ps-lg-3">
           <ul class="mb-0 list-unstyled">
             <li class="nav-item dropdown ">
               <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 <img class="rounded-circle me-1 user_image" src="./assets/default-profile-picture.png" alt="picture" >  <?php
    // Check if the username is set in the session
    if (isset($_SESSION['username'])) {
      echo $_SESSION['username'];
    }
    ?>
               </a>
               <ul class="dropdown-menu bg-primary">
                 <li><a class="dropdown-item text-white" href="profile.php"><i class="bi bi-person-circle me-1"></i> Profile</a></li>
                 <li><a class="dropdown-item text-white" href="logout.php"><i class="bi bi-box-arrow-right me-1"></i> Logout</a></li>
               </ul>
             </li>
           </ul>
         </div>
       </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
  <div class="table-responsive"></div>
    <table class="table table-bordered table-striped">
        <thead class="border border-primary">
            <tr>
                <th colspan="4">
                    <h2 class="mb-4">Profile: <?php echo $username; ?></h2>
                </th>
            </tr>
        </thead>
        <tbody class="border border-primary">
            <!-- Update Username Form -->
            <form method="post" action="">
                <tr>
                    <td>
                        <strong>Current Username:</strong>
                        <br>
                         <?php echo $user['username']; ?>
                    </td>
                    <td colspan="2">
                        <label for="new_username"><strong>Update Username:</strong></label>
                        <input type="text" name="new_username" class="form-control" required placeholder="New Username...">
                    </td>
                    <td>
                        <button type="submit" name="update_username" class="btn btn-primary" onclick="showConfirmationPopup('update_username')">Update Username</button>
                    </td>
                </tr>
            </form>

            <!-- Update Email Form -->
            <form method="post" action="">
                <tr>
                    <td >
                        <strong>Current Email:</strong>
                        <br>
                         <?php echo $user['email']; ?>
                    </td>
                    <td colspan="2">
                        <label for="new_email"><strong>Update Email:</strong></label>
                        <input type="email" name="new_email" class="form-control" required placeholder="New Email...">
                    </td>
                    <td>
                        <button type="submit" name="update_email" class="btn btn-primary" onclick="showConfirmationPopup('update_email')">Update Email</button>
                    </td>
                </tr>
            </form>

            <!-- Update Password Form -->
            <form id="update_password_form" method="post" action="">
                <tr>
                    <td>
                        <label for="current_password"><strong>Current Password:</strong></label>
                        <input type="password" name="current_password" id="current_password" class="form-control" oninput="checkCurrentPassword()" required placeholder="Current Password...">
                    </td>
                    <td colspan="2">
                        <label for="new_password"><strong>New Password:</strong></label>
                        <input type="password" name="new_password" class="form-control" required placeholder="New Password...">
                    </td>
                    <td>
                        <button type="submit" name="update_password" id="update_password_button" class="btn btn-primary" disabled>Update Password</button>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</div>



<script>
    // Function to show the confirmation popup
    function showConfirmationPopup(type) {
        var confirmation = confirm("Are you sure you want to update " + type + "?");

        if (confirmation) {
            // If the user clicks 'OK', submit the form
            document.getElementById(type + "_form").submit();
        } else {
            // If the user clicks 'Cancel', do nothing
        }
    }
</script>
<script>
 function checkCurrentPassword() {
    var currentPassword = document.getElementById('current_password').value;

    // Use AJAX to send the current password to the server for verification
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            // Enable or disable the "Update Password" button based on the response
            document.getElementById('update_password_button').disabled = !response.isValid;
        }
    };
    
    xhr.open('POST', 'check_password.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('current_password=' + currentPassword);
 }
</script>
  </body>
</html>