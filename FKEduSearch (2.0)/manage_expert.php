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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="content_style.css">
    
    <title>Manage Expert</title>
</head>

<body>
    <!-- Side navigation pane -->
   <?php include 'side_navigation.php'; ?>

    <div class="content">
     <!-- Header area -->
     <?php include 'header.php'; ?>
     <!-- Add your content here -->

        <h1>Manage Expert</h1>
        <div class="add-content-button">
            <a href="javascript:void(0)" onclick="showAddExpertForm()">Add Expert</a>
        </div>
        <div class="white-box">
            <h2>Experts</h2>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Expert ID</th>
                        <th>Name</th>
                        <th>Research Areas</th>
                        <th>Academic Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connection.php';

                    // Retrieve the expert data from the database
                    $stmt = $conn->prepare("SELECT ExpertID, ExpertName, ExpertResearchArea, ExpertAcademicStatus FROM expert");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Display the expert data in a table
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['ExpertID'] . '</td>';
                        echo '<td>' . $row['ExpertName'] . '</td>';
                        echo '<td>' . $row['ExpertResearchArea'] . '</td>';
                        echo '<td>' . $row['ExpertAcademicStatus'] . '</td>';
                        echo "<td><a href='edit_expert.php?expertID=" . $row['ExpertID'] . "'>Edit</a> | <a href='delete_expert.php?expertID=" . $row['ExpertID'] . "' onclick='return confirm(\"Are you sure you want to delete this expert?\")'>Delete</a></td>";
                        echo '</tr>';
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

       <!-- Add Expert Form -->
            <div class="add-content-form" id="addExpertForm">
                <div class="form-container">
                    <span class="close-btn" onclick="hideAddExpertForm()">&times;</span>
                    <h3>Add Expert</h3>
                    <form action="add_expert.php" method="post" enctype="multipart/form-data">
                        <label for="expertName">Name:</label>
                        <input type="text" name="expertName" id="expertName" required>
                        <label for="researchAreas">Research Areas:</label>
                        <input type="checkbox" name="researchAreas[]" value="Network"> Network<br>
                        <input type="checkbox" name="researchAreas[]" value="Cybersecurity"> Cybersecurity<br>
                        <input type="checkbox" name="researchAreas[]" value="Software"> Software<br>
                        <input type="checkbox" name="researchAreas[]" value="Multimedia"> Multimedia<br>
                        <label for="academicStatus">Academic Status:</label>
                        <input type="text" name="academicStatus" id="academicStatus" required>
                        <label for="cv">CV:</label>
                        <input type="file" name="cv" id="cv" required accept=".pdf">
                        <label for="socialMedia">Social Media:</label>
                        <input type="url" name="socialMedia" id="socialMedia" required>
                        <button type="submit">Add</button>
                    </form>
                </div>
            </div>

        <script>
              function showAddExpertForm() {
                document.getElementById('addExpertForm').style.display = 'block';
            }

            function hideAddExpertForm() {
                document.getElementById('addExpertForm').style.display = 'none';
            }
        </script>
          
    </div>
</body>

</html>
