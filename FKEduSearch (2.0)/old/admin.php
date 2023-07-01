<?php
session_start();
// if (!isset($_SESSION["admin"])) {
	// echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<div class="container h-100 d-flex align-items-center">
		<div class="row w-100 g-3">
			<div class="col-12">
				<a class="btn btn-primary" href="./controllers/logout.php">
					Logout
				</a>
			</div>
			<div class="col-12">
				<h3>User List</h3>
			</div>
			<div class="col-12">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user_form">
					Add User
				</button>
			</div>
			<div class="col-12">
				<div class="table-responsive w-100">
					<table class="table table-hover table-bordered w-100" id="user_table">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<!-- <th>Email</th>
							 -->
								<th>Role</th>
								<th>View</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php
							try {
								require "./config/database.php";
								$stmt = $conn->prepare("SELECT * FROM users ORDER BY UserID DESC");
								$stmt->execute();
								$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
								$count = 1;

								foreach ($result as $row) :
							?>
									<tr>
										<td><?php echo $count++; ?></td>
										<td><?php echo $row["UserName"]; ?></td>
										<!-- <td><a href="mailto:<?php echo $row["UserEmail"]; ?>"><?php echo $row["UserEmail"]; ?></a></td> -->
										<td>
											<?php
											if ($row["UserRole"] == 0) :
												echo "Admin";
											elseif ($row["UserRole"] == 1) :
												echo "Expertise";
											elseif ($row["UserRole"] == 2) :
												echo "User";
											endif;
											?>
										</td>
										<td class="text-center">
											<a class="btn btn-info" href="./profile.php?UserID=<?php echo $row["UserID"]; ?>">View</a>
										</td>
										<td class="text-center"><a class="btn btn-danger" href="./controllers/delete.php?UserID=<?php echo $row["UserID"]; ?>" onclick="return confirm('Are you sure to delete <?php echo $row['UserName']; ?> ?')">Delete</a></td>
									</tr>
							<?php
								endforeach;
							} catch (PDOException $e) {
								echo $e->getMessage();
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="user_form" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content px-5 py-3">
				<div class="modal-header">
					<h5 class="modal-title">Add User</h5>
				</div>
				<form action="./controllers/add.php" class="needs-validation" method="post" novalidate>
					<div>
						<label for="username" class="form-label">Username</label>
						<input type="text" class="form-control" name="username" id="username" required>
						<div class="invalid-feedback">
							Please enter an username.
						</div>
					</div>
					<div>
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" required>
						<div class="invalid-feedback">
							Please enter a password.
						</div>
					</div>
					<!-- <div> 
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" required>
						<div class="invalid-feedback">
							Please enter an email.
						</div>-->
					</div>
					<div>
						<label for="role">Role</label>
						<select name="role" class="form-select" id="role" required>
							<option value="" selected></option>
							<option value="0">Admin</option>
							<option value="1">Expertise</option>
							<option value="2">User</option>
						</select>
						<div class="invalid-feedback">
							Please select a role.
						</div>
					</div>

					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="create" value="Create">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="script.js"></script>
	<script src="./js/validation.js"></script>
</body>

</html>
