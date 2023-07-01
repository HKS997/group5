<?php
session_start();
?>

<?php

include 'db_connection.php';

$stmt = $conn->prepare("SELECT COUNT(*) as total_posts FROM post");
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalPosts = $row['total_posts'];

// Fetch user role data from the database
$query = "SELECT PostContent, COUNT(*) AS Count FROM post GROUP BY PostContent";
$result = $conn->query($query);

$userRoles = array();
$userCounts = array();

// Store the user role data in arrays
while ($row = $result->fetch_assoc()) {
    $userRoles[] = $row['PostContent'];
    $userCounts[] = $row['Count'];
}


// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="content_style.css">
  <title>Edit User</title>
  
</head>

  <body>
     <!-- Side navigation pane -->
   <?php include 'side_navigation.php'; ?>

    <div class="content">
      <div class="container">
      <!-- Add your content here -->
        <h2>Edit User</h2>

        <?php
        // Check if the user ID is provided
        if (!isset($_GET['userID'])) {
          header("Location: manage_report.php");
          exit();
          }

          ?>


<div class="total-users">
            <h3>Total Posts</h3>
            <p><?php echo $totalPosts; ?></p>
        </div>

        <div style="display: flex; justify-content: center;">
  <div style="width: 600px; height: 400px;">
    <canvas id="userRoleChart"></canvas>
  </div>
</div>
<style>
  canvas {
    width: 100%;
    height: 100%;
  }
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Create a graph using Chart.js
  var ctx = document.getElementById('userRoleChart').getContext('2d');
  var userRoleChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($complaintTypes); ?>,
      datasets: [
        {
          label: 'User Roles',
          data: <?php echo json_encode($userCounts); ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: false, // Disable responsiveness
      maintainAspectRatio: false, // Disable aspect ratio calculation
     
      scales: {
        y: {
          beginAtZero: true,
          stepSize: 1
        }
      }
    }
  });
</script>
              
        </body>
      
    
  </body>

</html>
