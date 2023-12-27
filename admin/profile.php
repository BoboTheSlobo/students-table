<?php
 include 'auth_session.php';
 include 'header.php';
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