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

    <title>Manage Users</title>

</head>

<body>
    <!-- Side navigation pane -->
   <?php include 'side_navigation.php'; ?>

   <div class="content">
        <!-- Header area -->
        <?php include 'header.php'; ?>
        <!-- Add your content here -->
        <h1>Manage User</h1>
        <div class="add-content-button">
            <a href="javascript:void(0)" onclick="showAddUserForm()">Add User</a>
        </div>
        <div class="white-box">
            <h2>Users</h2>
            <div class="content-table">
                <!-- Search Form -->
                <form action="" method="GET" class="search-form">
                    <!-- Your form inputs here -->
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">Search</button>
                </form>
            </div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include 'db_connection.php';

                    // Check if the search query is set
                    if (isset($_GET['search'])) {
                        // Sanitize the search query to prevent SQL injection
                        $search = "%" . mysqli_real_escape_string($conn, $_GET['search']) . "%";

                    // Only admin can search all users
                    $stmt = $conn->prepare("SELECT UserID, UserName, UserEmail, UserRole, UserStatus FROM user WHERE UserName LIKE ? OR UserRole LIKE ? OR UserStatus LIKE ?");
                    $stmt->bind_param("sss", $search, $search, $search);

                    // Execute the prepared statement
                    $stmt->execute();

                    // Get the result set
                    $result = $stmt->get_result();

                    // Display the search results in a table
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['UserID'] . '</td>';
                        echo '<td>' . $row['UserName'] . '</td>';
                        echo '<td>' . $row['UserEmail'] . '</td>';
                        echo '<td>' . $row['UserRole'] . '</td>';
                        echo '<td>' . $row['UserStatus'] . '</td>';
                        echo "<td><a href='edit_user.php?userID=" . $row['UserID'] . "'>Edit</a> | <a href='delete_user.php?userID=" . $row['UserID'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                        echo '</tr>';
                    }

                    // Close the prepared statement
                    $stmt->close();
                } else {
                    // If no search query is provided, retrieve and display all users

                    // Admin can view all users
                    $query = "SELECT UserID, UserName, UserEmail, UserRole, UserStatus FROM user";

                    // Execute the query and fetch the results
                    $result = $conn->query($query);

                    // Display the users in a table
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['UserID'] . '</td>';
                        echo '<td>' . $row['UserName'] . '</td>';
                        echo '<td>' . $row['UserEmail'] . '</td>';
                        echo '<td>' . $row['UserRole'] . '</td>';
                        echo '<td>' . $row['UserStatus'] . '</td>';
                        echo "<td><a href='edit_user.php?userID=" . $row['UserID'] . "'>Edit</a> | <a href='delete_user.php?userID=" . $row['UserID'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
                        echo '</tr>';
                    }
                    // Close the database connection
                    $conn->close();
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Add User Form -->
        <div class="add-content-form" id="addUserForm">
            <div class="form-container">
                <span class="close-btn" onclick="hideAddUserForm()">&times;</span>
                <h3>Add User</h3>
                <form action="<?php echo ($role == 'expertise') ? 'add_expert.php' : 'add_user.php'; ?>" method="post">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" required>
                    <label for="role">Role:</label>
                    <select name="role" id="role" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="expertise">Expertise</option>
                    </select>
                    <label for="status">Status:</label>
                    <select name="status" id="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <button type="submit">Add</button>
                </form>
            </div>
        </div>


        <script>
            function showAddUserForm() {
                document.getElementById('addUserForm').style.display = 'block';
            }

            function hideAddUserForm() {
                document.getElementById('addUserForm').style.display = 'none';
            }
        </script>
    </div>
</body>

</html>
