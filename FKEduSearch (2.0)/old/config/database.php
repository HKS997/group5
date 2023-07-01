<?php
$servername = "localhost";
$username = "php-tutorial-user";
$password = "php-tutorial-pwd";
$dbname = "php-tutorial-db";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}
