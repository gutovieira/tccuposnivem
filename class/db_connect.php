<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db_tcc2";

    $mysqli = new mysqli($host, $user, $pass, $db);
    
    if ($mysqli->connect_errno)
        echo "Failed to connect to DB: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
?>