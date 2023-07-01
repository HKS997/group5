<?php
session_start();

include 'db_connection.php';

// Get the entered username and password from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare the SQL statement to fetch user details
$stmt = $conn->prepare("SELECT UserName, UserRole FROM user WHERE UserName = ? AND UserPassword = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// If a matching user is found, set the session and redirect to the appropriate dashboard
if ($row) {
    $_SESSION['username'] = $row['UserName'];
    $_SESSION['role'] = $row['UserRole'];

    if ($row['UserRole'] == "admin") {
        header("Location: admin.php");
        exit();
    } elseif ($row['UserRole'] == "user") {
        header("Location: user.php");
        exit();
    } elseif ($row['UserRole'] == "expertise") {
        header("Location: expertise.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid username or password";
    header("Location: index.html");
    exit();
}

?>
