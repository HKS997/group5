<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input values
    $username = $_POST["UserName"];
    $password = $_POST["UserPassword"];

    // Connect to the database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "fkedusearch";

    $conn = new mysqli($servername, $db_UserName, $db_UserPassword, $fkedusearch);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the query to validate user credentials
    $sql = "SELECT * FROM users WHERE username='$UserName' AND password='$UserPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User is authenticated, fetch the user's role
        $row = $result->fetch_assoc();
        $role = $row["role"];

        // Set the session based on the user's role
        if ($role == "admin") {
            $_SESSION["role"] = "admin";
            header("Location: admin.php");
        } elseif ($role == "user") {
            $_SESSION["role"] = "user";
            header("Location: user.php");
        } elseif ($role == "expertise") {
            $_SESSION["role"] = "expertise";
            header("Location: expertise.php");
        }
        exit();
    } else {
        // Invalid credentials, show an error message
        $error = "Invalid username or password";
    }

    $conn->close();
}
?>
