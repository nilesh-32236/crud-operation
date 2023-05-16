<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "nilesh";
    $conn = new mysqli($hostname, $username, $password, $database);
    if($conn->connect_error){
        die("Connection fauled".$conn->connect_error);
    }
?>