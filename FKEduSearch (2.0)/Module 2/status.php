<?php
// Connect to the database
$link = mysqli_connect("localhost", "root", "", "miniproject") or die(mysqli_connect_error($link));

// Check if post_id and status parameters are set
if (isset($_GET['post_id']) && isset($_GET['status'])) {
    $postID = $_GET['post_id'];
    $status = $_GET['status'];

    // Update the status of the post in the database
    $query = "UPDATE post SET post_status = '$status' WHERE post_id = '$postID'";
    mysqli_query($link, $query);

    // Redirect back to the homepage or the page where the status was changed
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Close the database connection
mysqli_close($link);
?>
