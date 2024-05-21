<?php
	// Connection to DB

	$address="127.0.0.1";
	$user= "root";
	$pass= "1111";
	$port=3307;
	$database="password_manager";

	$conn = new PDO("mysql:host=$address;port=$port;dbname=$database", $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>