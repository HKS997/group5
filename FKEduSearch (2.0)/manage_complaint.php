<?php
session_start();

// Check if the user's role is set in the session
    if (isset($_SESSION['role'])) {
        $role = $_SESSION['role'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
  <link rel="stylesheet" type="text/css" href="content_style.css">

  <title>Manage Complaint</title>
  
</head>

<body>
   <!-- Side navigation pane -->
   <?php include 'side_navigation.php'; ?>

   <div class="content">
        <!-- Header area -->
        <?php include 'header.php'; ?>
        <!-- Add your content here -->
  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <h1>Manage Complaint</h1>
    <div class="add-content-button">
            <a href="javascript:void(0)" onclick="showAddComplaintForm()">Add Complaint</a>
    </div>

    <div class="white-box">
            <h2>Complaint</h2>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>ComplaintID ID</th>
                        <th>UserID</th>
                        <th>FeedbackID</th>
                        <th>ComplaintType</th>
                        <th>ComplaintDateTime</th>
                        <th>ComplaintStatus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                  <?php
                     include 'db_connection.php';

                     // Retrieve the expert data from the database
                     $stmt = $conn->prepare("SELECT ComplaintID, UserID, FeedbackID, ComplaintType, ComplaintDateTime, ComplaintStatus FROM complaint");
                     $stmt->execute();
                     $result = $stmt->get_result();

                     // Display the expert data in a table
                     while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['ComplaintID'] . '</td>';
                        echo '<td>' . $row['UserID'] . '</td>';
                        echo '<td>' . $row['FeedbackID'] . '</td>';
                        echo '<td>' . $row['ComplaintType'] . '</td>';
                        echo '<td>' . $row['ComplaintDateTime'] . '</td>';
                        echo '<td>' . $row['ComplaintStatus'] . '</td>';
                        echo '<td>
                        <a href="edit_complaint.php?ComplaintID=' . $row['ComplaintID'] . '" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="delete_complaint.php?ComplaintID=' . $row['ComplaintID'] . '" class="link-dark" onclick="return confirm(\'Are you sure you want to delete this expert?\')"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>';
                        echo '</tr>';
                     }

                     // Close the database connection
                     $conn->close();
                     ?>
                </tbody>
            </table>
        </div>

       <!-- Add Complaint Form -->
            <div class="add-content-form" id="addComplaintForm" style="display: none;">
                <div class="form-container">
                    <span class="close-btn" onclick="hideAddComplaintForm()">&times;</span>
                    <h3>Add Complaint</h3>
                    <form action="add_complaint.php" method="post" enctype="multipart/form-data">
                        <label for="complaintType">Complaint Type:</label>
                        <select name="complaintType" id="complaintType" required>
                            <option value="Unsatisfied Experts Feedback">Unsatisfied Experts Feedback</option>
                            <option value="Wrongly Assigned Research Area">Wrongly Assigned Research Area</option>
                            <option value="Others">Others...</option>
                        </select>
                        <label for="complaintDescription">Description:</label>
                        <input type="text" name="complaintDescription" id="complaintDescription">
                        <label for="complaintDateTime">Date & Time:</label>
                        <input type="text" name="complaintDateTime" id="complaintDateTime" readonly>
                        <label for="complaintStatus">Complaint Status:</label>
                        <select name="complaintStatus" id="complaintStatus" required>
                            <option value="NULL">Please select</option>
                            <option value="In Investigation">In Investigation</option>
                            <option value="On Hold">On Hold</option>
                            <option value="Resolved">Resolved...</option>
                        </select>
                        <button type="submit" name="submit">Add</button>
                    </form>
                </div>
            </div>

            <script>
                function showAddComplaintForm() {
                    document.getElementById('addComplaintForm').style.display = 'block';
                }

                function hideAddComplaintForm() {
                    document.getElementById('addComplaintForm').style.display = 'none';
                }

                // Function to auto-generate date and time
                function generateDateTime() {
                    var currentDateTime = new Date();
                    var formattedDateTime = currentDateTime.toLocaleString();
                    document.getElementById("complaintDateTime").value = formattedDateTime;
                }

                // Call the function to generate date and time when the form is loaded
                window.onload = generateDateTime;
            </script>
   
    </div>
  </div>

 
</body>

</html>