<?php

    include_once "connect.php";

    $id = $_GET["id"];

    $sql="DELETE FROM `password_manager`.`password` WHERE id=$id";

	if ($conn->query($sql) == TRUE) {
		print("Removed password with id=" . $id . "!<br/>");
		print("<a href=./main.php>Main page</a>");
    } 
    else {
        print("Error");
    }



