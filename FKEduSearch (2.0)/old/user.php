<?php
session_start();
if (!isset($_SESSION["user"])) {
	echo "<script>alert('You are disallowed to access this page'); window.location.href='./';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User</title>
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<h1>this is user page</h1>
	<script src="script.js"></script>
</body>

</html>
