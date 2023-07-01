<?php
session_start();

// Check if the user is not logged in or does not have admin role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
    exit; // Stop further execution of the script
}

// Database credentials
include 'db_connection.php';

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Landing Page</title>
    <style>
        /* CSS for side navigation pane */
        .sidenav {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #f1f1f1;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 16px;
            color: #333;
            display: block;
        }

        .sidenav a:hover {
            background-color: #ddd;
        }

        /* CSS for content area */
        .content {
            margin-left: 200px;
            padding: 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .logo {
            width: 40px;
            height: 40px;
            padding-right: 10px;
        }

        .logo-text {
            font-size: 16px;
            font-weight: bold;
        }


        .header {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            background-color: #f1f1f1;
        }

        .header a {
            margin-left: 10px;
            text-decoration: none;
            color: #333;
        }

        .create-post-button {
            margin-bottom: 20px;
            text-align: right;
        }

        .create-post-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #B7FFEE;
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }

        .create-post-button a:hover {
            background-color: #a2f5e1;
        }

        .total-users {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        /* Style for the chart container */
        .chart-container {
            width: 20%;
            max-width: 600px;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <!-- Side navigation pane -->
    <div class="sidenav">
        <div class="logo-container">
            <img src="fk.png" alt="Logo" class="logo">
            <span class="logo-text">FK-EduSearch</span>
        </div>
        <a href="users.php">Home</a>
        <a href="manage_post.php">Manage Post</a>
        <a href="manage_complaint.php">Manage Complaint</a>
        <!-- Add more navigation links if needed -->
    </div>

    <!-- Content area -->
    <div class="content">
        <!-- Add your content here -->
        <div class="header">
            <a href="logout.php">Logout</a>
        </div>
        <h1>Dashboard</h1>

        <!-- Create Post Button -->
        <div class="create-post-button">
            <a href="add_post.php">Create Post</a>
        </div>
    </div>
</body>

</html>