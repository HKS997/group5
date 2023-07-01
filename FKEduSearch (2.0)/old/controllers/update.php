<?php
session_start();
if (!isset($_SESSION["admin"])) {
	echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
}

if (isset($_GET['update'])) {
	try {
		require "../config/database.php";

		$userid = $_GET["userid"];
		$username = $_GET["username"];
		$role = $_GET["role"];

		$stmt = $conn->prepare("UPDATE users SET UserName = :username, UserRole = :role WHERE UserID = :userid");
		$stmt->bindParam(':userid', $userid);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':role', $role);

		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			echo "<script>alert('The user profile has been updated'); window.location.href='../admin.php';</script>";
			exit();
		} else {
			echo "<script>alert('No changes were made to the user profile'); window.location.href='../admin.php';</script>";
			exit();
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
		exit();
	}
} else {
	echo "<script>alert('Invalid request'); window.location.href='../admin.php';</script>";
	exit();
}
