<?php

    session_start();
    session_destroy();

    echo "Logout successfull!<br/>";
    print ('<a href="../index.php">Login</a>');
