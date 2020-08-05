<?php
    //1.create connection
    $host = "localhost";
    $db_username = "root";
    $db_passwd = "";
    $db_name = "phardb";

    $conn;

    try {
        $conn = mysqli_connect($host, $db_username, $db_passwd, $db_name);
    } catch (Exception $exp) {
        echo "Connection error: " . $exp.getMessage();
    }

?>