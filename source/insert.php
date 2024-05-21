
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP PHP Final</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>
    <h2>Add new password</h2>
    <div>
        <form action="./insert.php" method="POST">
            <input type="text" name="system" placeholder="System" />
            <h3>Password settings</h3>
            <input type="number" name="upper" placeholder="Upper letters" />
            <input type="number" name="lower" placeholder="Lower letters" />
            <input type="number" name="special" placeholder="Special characters" />
            <input type="number" name="number" placeholder="Numbers" />
            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>


<?php 

    include_once "connect.php";
    include_once "Cipher.php";
    include_once "PasswordGenerator.php";

    session_start();

    if (!isset($_SESSION["id"])){
        echo ('User is not loggined!<br/>');
        print ('<a href="../index.php">Login</a>');
        exit(0);
    }

    $system = "";
    $upper = 0;
    $lower = 0;
    $special = 0;
    $number = 0;

    if(isset($_POST["system"])){
        $system = htmlentities($_POST["system"]);
    }
    if(isset($_POST["upper"])){
        $upper = htmlentities($_POST["upper"]);
    }
    if(isset($_POST["lower"])){
        $lower = htmlentities($_POST["lower"]);
    }
    if(isset($_POST["special"])){
        $special = htmlentities($_POST["special"]);
    }
    if(isset($_POST["number"])){
        $number = htmlentities($_POST["number"]);
    }

    $generator = new PasswordGenerator();

    $rand_password = $generator->generate($upper, $lower, $number, $special);

    if ($rand_password != "") {
        echo "Your password for " . $system . " is " . $rand_password . "<br/>";
    }

    $cipher = new Cipher($_SESSION["token"], "AES-256-CBC");

    $encrypted = $cipher->encrypt($rand_password);
    if ($rand_password != "") {
        $sql="INSERT INTO `password_manager`.`password` (`system`,`password`,`user_id`) VALUES ('" . $system . "','" . $encrypted . "','" . $_SESSION["id"] . "')";
    }   

    if ($rand_password != "") {
        if ($conn->query($sql) == TRUE) {
            print ("Password saved<br/>");
            print ("<a href='./main.php'>Main page</a>");
        } else {
            print ("Error");
            print ("<a href='./main.php'>Main page</a>");
        }
    }

?>
