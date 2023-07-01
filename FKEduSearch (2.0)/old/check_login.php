<?php
// Retrieve the entered username and password from the AJAX request
$UserName = $_POST["UserName"];
$UserPassword = $_POST["UserPassword"];

// Perform the database query to validate the credentials
// Replace this with your actual database query code
// Example code: query the users table to find a match
// You may need to modify this code to match your database structure
$result = $conn->query("SELECT * FROM users WHERE UserName = '$UserName' AND UserPassword = '$UserPassword'");

// Check if a match was found
if ($result->num_rows > 0) {
  // Valid credentials, get the role from the database result
  $row = $result->fetch_assoc();
  $UserRole = $row["UserRole"];

  // Return a JSON response indicating success and the role
  $response = array("success" => true, "UserRole" => $UserRole);
  echo json_encode($response);
} else {
  // Invalid credentials, return a JSON response with an error message
  $response = array("success" => false, "message" => "Invalid username or password");
  echo json_encode($response);
}
?>
