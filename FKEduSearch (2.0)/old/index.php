<?php
session_start();

if (isset($_SESSION["admin"]) || isset($_SESSION["staff"]) || isset($_SESSION["user"])) {
	if (isset($_SESSION["admin"])) {
		header("location: ./admin.php");
	} elseif (isset($_SESSION["user"])) {
		header("location: ./user.php");
	} elseif (isset($_SESSION["expertise"])) {
		header("location: ./expertise.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<style>
		body {
			background-color: #B7FFEE;
		}

		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.form-box {
			background-color: #fff;
			padding: 30px;
			border-radius: 10px;
		}

		.form-title {
			text-align: center;
			margin-bottom: 20px;
			color: #999;
		}

		.form-label {
			color: #999;
		}

		.form-control {
			color: #999;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="form-box">
			<form action="./controllers/login.php" class="needs-validation row g-3 px-md-5 px-3" method="post" novalidate>
				<img src="fk.png" alt="Logo" style="width: 100px; height: 100px; margin: 0 auto;">
				<h2 class="fw-bold form-title">FK-EduSearch</h2>
				<?php if (isset($_SESSION['error'])) : ?>
					<div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
						<i class="bi bi-exclamation-triangle-fill h5"></i> <?php echo $_SESSION['error']; ?>.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php
					unset($_SESSION['error']);
				endif;
				?>
				<div class="col-12">
					<!-- <label for="username" class="form-label"><b>Username</b></label> -->
					<input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Username" required>
					<div class="invalid-feedback">
						<!-- Please enter your username. -->
					</div>
				</div>
				<div class="col-12">
					<!-- <label for="password"><b>Password</b></label> -->
					<input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password" required>
					<div class="invalid-feedback">
						<!-- Please enter your password. -->
					</div>
				</div>
				<div class="col-12">
					<!-- <label for="role"><b>Role</b></label> -->
					<select name="role" class="form-select" id="role" required>
						<option value="" hidden>Select Role</option>
						<option value="user">User</option>
						<option value="admin">Admin</option>
						<option value="expertise">Expertise</option>
					</select>
					<div class="invalid-feedback">
						<!-- Please select a role. -->
					</div>
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-primary col-3" name="login"><b>Log In</b></button>
				</div>
			</form>
		</div>
	</div>
	<script src="script.js"></script>
	<script src="./js/authentication.js"></script>
</body>

</html>
