<?php
include 'db_connection.php';

// Check if the postID is provided in the URL
if (isset($_GET['report_id'])) {
    $postID = $_GET['report_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Delete confirmation received
        $confirmation = $_POST['confirmation'];

        if ($confirmation === 'yes') {
            // Prepare and execute the delete statement
            $stmt = $conn->prepare("DELETE FROM report WHERE report_id = ?");
            $stmt->bind_param("i", $postID);
            $stmt->execute();

            // Check if the delete operation was successful
            if ($stmt->affected_rows > 0) {
                echo "report deleted successfully.";
            } else {
                echo "Failed to delete report.";
            }

            // Close the statement
            $stmt->close();

            // Redirect back to manage_post.php
            header("Location: manage_report.php");
            exit();
        } else {
            echo "Deletion canceled.";
            header("Location: manage_report.php");
            exit();
        }
    } else {
        // Retrieve the post data from the database
        $stmt = $conn->prepare("SELECT title FROM report WHERE report_id = ?");
        $stmt->bind_param("i", $report_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        // Display delete confirmation
       // echo "Are you sure you want to delete report: " . $post['title'] . "?<br>";
        echo '<form method="POST" action="">';
        echo '<input type="hidden" name="report_id" value="' . $report_id . '">';
        echo 'Confirmation: <input type="radio" name="confirmation" value="yes"> Yes ';
        echo '<input type="radio" name="confirmation" value="no" checked> No ';
        echo '<button type="submit">Submit</button>';
        echo '</form>';
    }
} else {
    echo "report_id not provided.";
}

// Close the database connection
$conn->close();
?>
