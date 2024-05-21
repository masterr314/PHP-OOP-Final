<?php
    
    include_once "connect.php";

    $username = "";
    $email = "";
	$password = "";

    if(isset($_POST["username"])){
		$password = htmlentities($_POST["username"]);
	}
	if(isset($_POST["email"])){
		$email = htmlentities($_POST["email"]);
	}
	if(isset($_POST["password"])){
		$username = htmlentities($_POST["password"]);
	}

    $password = password_hash($password, PASSWORD_DEFAULT);
    $token = md5(microtime(true).mt_Rand());

	$sql="INSERT INTO user (username, email, password, token) VALUES ('" . $username . "','" . $email . "','" . $password . "','" . $token ."')";

    if ($conn->query($sql) == TRUE) {
		print ("User added<br/>");
		print ("<a href='../index.php'>Login</a>");
	} else {
		print ("Error");
	}
