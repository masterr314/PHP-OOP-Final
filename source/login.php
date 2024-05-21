<?php
    
    include_once "connect.php";
    session_start();

    $login = "";
	$password = "";

    if(isset($_POST["login"])){
		$login = htmlentities($_POST["login"]);
	}
	if(isset($_POST["password"])){
		$password = htmlentities($_POST["password"]);
	}

    $sql="SELECT * FROM $database.user WHERE email='" . $login . "' OR username='" . $login . "';";

    $data = $conn->query($sql)->fetchObject();

    $data = json_decode(json_encode($data), true);

    if (password_verify($password, $data['password'])){
        $_SESSION["id"] = $data['id'];
        $_SESSION["username"] = $data['username'];
        $_SESSION["email"] = $data['email'];
        $_SESSION["password"] = $data['password'];
        $_SESSION["token"] = $data['token'];
        echo "Login successfull!<br/>";
        print ("<a href='./main.php'>Main</a>");
    }
    else {
        echo '<br/>Wrong password!';
    }

