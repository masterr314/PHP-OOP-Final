<?php

    include_once "connect.php";
    include_once "Cipher.php";
    session_start();

    if (!isset($_SESSION["id"])){
        echo ('User is not loggined!<br/>');
        print ('<a href="../index.php">Login</a>');
        exit(0);
    }
    else {
        print ("<a href=logout.php>Logout</a><br/>");
        echo "<h2>User main page</h2>";
        echo '<a href="./insert.php">Add new password</a>';
    }

    $sql="SELECT * FROM $database.password WHERE user_id=" . $_SESSION["id"] . ";";
    $data = $conn->query($sql)->fetchAll();
    $data = json_decode(json_encode($data), true);

    $cipher = new Cipher($_SESSION["token"], "AES-256-CBC");
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">System</th>
      <th scope="col">Password</th>
      <th scope="col">Creation Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
        for ($i=0; $i < count($data); $i++)
        {   
            echo "<tr>";
            echo '<th scope="row">'. $i . '</th>';
            echo "<td>" . $data[$i]["system"] . "</td>";
            echo "<td>" . $cipher->decrypt($data[$i]["password"]) . "</td>";
            echo "<td>" . $data[$i]["created_at"]. "</td>";
            echo "<td><a href='./delete.php?id=" . $data[$i]['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
    ?>
  </tbody>
</table>


