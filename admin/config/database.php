<?php
    require "config/constants.php";

    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_errno($connection)) {
        die(mysqli_error($connection));
    }

    // if($connection->connect_error) {
    //     die("Connection Failed ". $connection->connect_error);
    // }