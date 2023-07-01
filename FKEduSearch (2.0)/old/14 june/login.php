<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input values
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "fkedusearch";

    $conn = new mysqli($servername, $db_username, $db_password, $fkedusearch);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the query to validate user credentials
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User is authenticated, fetch the user's role
        $row = $result->fetch_assoc();
        $role = $row["role"];

        // Set the session based on the user's role
        if ($role == 0) {
            $_SESSION["role"] = "admin";
            header("Location: admin.php");
        } elseif ($role == 1) {
            $_SESSION["role"] = "expertise";
            header("Location: expertise.php");
        } elseif ($role == 2) {
            $_SESSION["role"] = "user";
            header("Location:user.php");
        }
        exit();
    } else {
        // Invalid credentials, show an error message
        $error = "Invalid username or password";
    }

    $conn->close();
}
?>
