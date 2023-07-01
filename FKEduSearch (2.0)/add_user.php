<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $status = $_POST['status'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO user (UserName, UserPassword, UserEmail, UserRole, UserStatus) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $role, $status);
    $stmt->execute();

    // Redirect to the manage_user.php page after adding the user
    header("Location: manage_user.php");
    exit();
}
?>
