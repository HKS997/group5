<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <style>
    /* CSS for side navigation pane */
    .sidenav {
      height: 100%;
      width: 200px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #f1f1f1;
      overflow-x: hidden;
      padding-top: 20px;
    }

    .sidenav a {
      padding: 6px 8px 6px 16px;
      text-decoration: none;
      font-size: 16px;
      color: #333;
      display: block;
    }

    .sidenav a:hover {
      background-color: #ddd;
    }

    /* CSS for content area */
    .content {
      margin-left: 200px;
      padding: 20px;
    }

    .logo {
      width: 75px;
      height: 75px;
      padding: 5px;
      text-align: center;
    }

    /* Add User Form */
    .add-user-form {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .add-user-form h3 {
      margin-top: 0;
      text-align: center;
    }

    .add-user-form label {
      display: block;
      margin-bottom: 5px;
    }

    .add-user-form input,
    .add-user-form select {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      /* Add this line */
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 10px;
    }

    .add-user-form button {
      padding: 8px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    .add-user-form button:hover {
      background-color: #555;
    }
  </style>
</head>

  <body>
    <!-- Side navigation pane -->
    <div class="sidenav">
      <img src="fk.png" alt="Logo" class="logo">
      <a href="admin.php">Home</a>
      <a href="manage_user.php">Manage User</a>
      <a href="manage_post.php">Manage Post</a>
      <!-- Add more navigation links if needed -->
    </div>

    <div class="content">
    <div class="container">
      <h2>Update User</h2>

      <?php
      include 'db_connection.php';

       // Check if the form is submitted
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the user ID and updated data from the form
        $userID = $_POST['userID'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        // Update the user data in the database
        $stmt = $conn->prepare("UPDATE user SET UserName = ?, UserPassword =?, UserEmail = ?, UserRole = ?, UserStatus = ? WHERE UserID = ?");
        $stmt->bind_param("sssssi", $username, $password, $email, $role, $status, $userID);
        
        if ($stmt->execute()) {
            // User data updated successfully
            echo "User data updated successfully.";
        } else {
            // Error occurred while updating user data
            echo "Error updating user data: " . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
        }

        if ($result->num_rows == 0) {
            header("Location: manage_user.php");
            exit();
        }
        ?>

    </div>
   </div>
  </body>

</html>