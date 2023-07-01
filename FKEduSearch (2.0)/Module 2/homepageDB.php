<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <style>
        /* CSS styles for the homepage */
    </style>
</head>
<body>
    <div id="posts">
        <?php
        // Connect to the database
        $link = mysqli_connect("localhost", "root", "your_password") or die(mysqli_connect_error());
        mysqli_select_db($link, "miniproject") or die(mysqli_error($link));

        // Fetch posts from the database
        $query = "SELECT * FROM posts";
        $result = mysqli_query($link, $query);

        // Display posts
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='post'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<a href='like.php?post_id=" . $row['id'] . "'>Like</a>";
            echo "<a href='comments.php?post_id=" . $row['id'] . "'>Comments</a>";
            echo "</div>";
        }

        // Close the database connection
        mysqli_close($link);
        ?>
    </div>
</body>
</html>
