<?php
session_start();
if (!isset($_SESSION["admin"])) {
	echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
}
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>profile</title>
	<link href="style.css" rel="stylesheet">
</head>

<body class="h-100">
	<div class="container h-100 d-flex align-items-center justify-content-center">
		<div class="row">
			<div class="col">
				<?php
				try {
					require "./config/database.php";
					$stmt = $conn->prepare("SELECT * FROM users WHERE UserID=:UserID");
					$stmt->bindParam(':UserID', $_GET['UserID']);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if ($stmt->rowCount() > 0) :
						foreach ($result as $row) :
				?>
							<form action="./controllers/update.php" class="row g-3 needs-validation shadow rounded-5 p-5" method="get" novalidate>
								<h3>User Profile</h3>
								<div class="col-6">
									<label for="userid" class="form-label">User ID</label>
									<input type="text" class="form-control" value="<?php echo $row["UserID"]; ?>" name="userid" id="userid" readonly required>
									<div class="invalid-feedback">
										Please enter an user id.
									</div>
								</div>

								<div class="col-6">
									<label for="username" class="form-label">Username</label>
									<input type="text" class="form-control" value="<?php echo $row["UserName"]; ?>" name="username" id="username" required>
									<div class="invalid-feedback">
										Please enter an username.
									</div>
								</div>

								<!-- <div class="col-6"> 
									<label for="password" class="form-label">Email</label>
									<input type="text" class="form-control" value="<?php echo $row["UserPassword"]; ?>" name="password" id="password" required>
									<div class="invalid-feedback">
										Please enter an email.
									</div>
								</div>-->

								<div class="col-6">
									<label for="role">Role</label>
									<select name="role" class="form-select" id="role" required>
										<option value="<?php echo $row["UserRole"]; ?>" hidden selected>
											<?php
											if ($row["UserRole"] == 0) :
												echo "Admin";
											elseif ($row["UserRole"] == 1) :
												echo "Expertise";
											elseif ($row["UserRole"] == 2) :
												echo "User";
											endif;
											?>
										</option>
										<option value="0">Admin</option>
										<option value="1">Expertise</option>
										<option value="2">User</option>
									</select>
									<div class="invalid-feedback">
										Please select a role.
									</div>
								</div>

								<div class="col-12">
									<input type="submit" class="btn btn-primary" name="update" value="Update">
									<button type="button" class="btn btn-danger" onclick="history.back();">Close</button>
								</div>
							</form>
				<?php
						endforeach;
					endif;
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
				?>
			</div>
		</div>
	</div>

	<script src="script.js"></script>
	<script src="./js/authentication.js"></script>
</body>

</html>
