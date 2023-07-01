<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $date = $_POST['date'];
  $type = $_POST['type'];
  $postid = $_POST['postid'];

  $sql = "UPDATE `input` SET `title`='$title',`description`='$description',`date`='$date',`type`='$type', `postid`='$postid' WHERE id = $id";


  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: manage_research.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Research Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `input` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Research Title:</label>
            <input type="text" class="form-control" name="title" value="<?php echo $row['title'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Research Description:</label>
            <input type="text" class="form-control" name="description" value="<?php echo $row['description'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Research Date:</label>
          <input type="date" class="form-control" name="date" value="<?php echo $row['date'] ?>">
        </div>

        <div class="form-group mb-3">
          <label>Research Type:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="type" id="journal" value="journal" <?php echo ($row["type"] == 'journal') ? "checked" : ""; ?>>
          <label for="journal" class="form-input-label">Journal</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="type" id="article" value="article" <?php echo ($row["type"] == 'article') ? "checked" : ""; ?>>
          <label for="article" class="form-input-label">Article</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="type" id="book" value="book" <?php echo ($row["type"] == 'book') ? "checked" : ""; ?>>
          <label for="book" class="form-input-label">Book</label>
        </div>

        <div class="mb-3">
               <label class="form-label">PostID:</label>
               <input type="text" class="form-control" name="postid" value="<?php echo $row['postid']; ?>" placeholder="PostID">

            </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="manage_research.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>