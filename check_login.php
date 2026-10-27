<?php
session_start();
require 'connection.php'; // Ensure connection.php is in the same folder (admin_simple/)

// Retrieve inputs matching the names from the form ('user' and 'pw')
$users = $_POST['user'] ?? '';
$pwd = $_POST['pw'] ?? '';

// Check against your 'tbl_users' table (matches columns: username, pwd)
// Note: Since your DB screenshot shows '12345' stored in plain text, we compare directly.
$sql = "SELECT * FROM tbl_users WHERE username = '$users' AND pwd = '$pwd'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Credentials match -> Set session and head to index.php
    $_SESSION['login'] = $users;
    header('Location:'.  ' index .php');
    exit();
} else {
    // Failed login -> Redirect back to login page located one folder up
    header('Location: ../login.php');
    exit();
}
?>