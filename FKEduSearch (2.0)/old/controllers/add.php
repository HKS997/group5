<?php
session_start();
if (!isset($_SESSION["admin"])) {
	echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
}

try {
	require "../config/database.php";

	$username = $_POST["username"];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$role = $_POST["role"];

	$stmt = $conn->prepare("INSERT INTO users (UserName, UserPassword, UserRole) VALUES (:username, :password, :role)");
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->bindParam(':role', $role);

	$stmt->execute();
	echo "<script>alert('The user has been added successfully.'); window.location.href='../admin.php';</script>";
} catch (PDOException $e) {
	echo $e->getMessage();
}

$conn = null;
