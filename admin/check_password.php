<?php
include 'auth_session.php';
require 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $currentPassword = $_POST['current_password'];

    // Fetch the user's hashed password from the database
    $passwordQuery = "SELECT password FROM users WHERE username = '$username'";
    $passwordResult = mysqli_query($con, $passwordQuery);

    if (!$passwordResult) {
        die("Error fetching user password: " . mysqli_error($con));
    }

    $passwordRow = mysqli_fetch_assoc($passwordResult);

    // Check if the current password is correct
    $isValid = password_verify($currentPassword, $passwordRow['password']);

    // Return the result as JSON
    header('Content-Type: application/json');
    echo json_encode(['isValid' => $isValid]);
}
?>
