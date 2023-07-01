<?php
session_start();
if (!isset($_SESSION["admin"])) {
	echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
}

try {
	require "../config/database.php";
	$stmt = $conn->prepare("DELETE FROM users WHERE UserID=:UserID");
	$stmt->bindParam(':UserID', $_GET['UserID']);
	$stmt->execute();
	echo "<script>alert('The user has been deleted successfully.'); window.location.href='../admin.php';</script>";
} catch (PDOException $e) {
	echo $e->getMessage();
}
