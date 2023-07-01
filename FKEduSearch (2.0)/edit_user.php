<?php
session_start();
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
          header("Location: manage_user.php");
          exit();
          }

          $userID = $_GET['userID'];

          include 'db_connection.php';

            // Retrieve the user data from the database
            $stmt = $conn->prepare("SELECT UserName, UserPassword, UserEmail, UserRole, UserStatus FROM user WHERE UserID = ?");
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the user exists
            if ($result->num_rows == 0) {
                header("Location: manage_user.php");
                exit();
            }

            $row = $result->fetch_assoc();

            $conn->close();
            ?>

        <!-- Edit User Form -->
        <body>
              <div class="edit-content-form">
                  <h2>Edit User</h2>
                  <form action="update_user.php" method="post">
                      <input type="hidden" name="userID" value="<?php echo $userID; ?>">
                      <label for="username">Username:</label>
                      <input type="text" name="username" id="username" value="<?php echo $row['UserName']; ?>" required>
                      <label for="password">Password:</label>
                      <input type="text" name="password" id="password" value="<?php echo $row['UserPassword']; ?>" required>
                      <label for="email">Email:</label>
                      <input type="text" name="email" id="email" value="<?php echo $row['UserEmail']; ?>" required>
                      <label for="role">Role:</label>
                      <select name="role" id="role" required>
                          <option value="admin" <?php if ($row['UserRole'] == 'admin') echo 'selected'; ?>>Admin</option>
                          <option value="user" <?php if ($row['UserRole'] == 'user') echo 'selected'; ?>>User</option>
                          <option value="expertise" <?php if ($row['UserRole'] == 'expertise') echo 'selected'; ?>>Expertise</option>
                      </select>
                      <label for="status">Status:</label>
                      <select name="status" id="status" required>
                          <option value="active" <?php if ($row['UserStatus'] == 'active') echo 'selected'; ?>>Active</option>
                          <option value="inactive" <?php if ($row['UserStatus'] == 'inactive') echo 'selected'; ?>>Inactive</option>
                      </select>
                      <button type="submit">Update</button>
                      <button type="button" onclick="cancelUpdate()">Cancel</button>
                  </form>

                  <script>
                      function cancelUpdate() {
                          window.location = "manage_user.php";
                      }
                  </script>
              </div>
        </body>
      </div>
    </div>
  </body>

</html>
