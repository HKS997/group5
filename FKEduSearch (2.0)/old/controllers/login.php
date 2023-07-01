<?php
require "../config/database.php";

try {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$stmt = $conn->prepare("SELECT * FROM users WHERE UserName=:username");
	$stmt->bindParam(":username", $username);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($result && password_verify($password, $result["UserPassword"])) {
		session_start();
		$_SESSION["user_id"] = $result["UserID"];
		$_SESSION["username"] = $result["UserName"];
		$_SESSION["user_password"] = $result["UserPassword"];
		// $_SESSION["user_email"] = $result["UserEmail"];

		if ($result["UserRole"] == 0) {
			$_SESSION["admin"] = $result["UserRole"];
			header("location: ../admin.php");
		} elseif ($result["UserRole"] == 1) {
			$_SESSION["expertise"] = $result["UserRole"];
			header("location: ../expertise.php");
		} elseif ($result['UserRole'] == 2) {
			$_SESSION["user"] = $result["UserRole"];
			header("location: ../user.php");
		}
	} else {
		session_start();
		$_SESSION["error"] = "Username or password is invalid";
		header("location: ../");
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}

$conn = null;
