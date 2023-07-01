<?php
// Connect to the database
$link = mysqli_connect("localhost", "root", "", "miniproject") or die(mysqli_connect_error());

// Check if post_id parameter is set
if (isset($_GET['post_id'])) {
    $postID = $_GET['post_id'];

    // Retrieve the current number of likes from the database
    $query = "SELECT post_likes FROM post WHERE post_id = '$postID'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $currentLikes = $row['post_likes'];

    // Increment the number of likes by 1
    $newLikes = $currentLikes + 1;

    // Update the number of likes in the database
    $query = "UPDATE post SET post_likes = '$newLikes' WHERE post_id = '$postID'";
    mysqli_query($link, $query);

    // Redirect back to the homepage
    header("Location: homepage.php");
    exit();
}

// Close the database connection
mysqli_close($link);
?>
