<?php
    session_start();
    require_once("connection.php");

    $id = $_GET["id"];

    // echo $id;

    $sqlQuery = "DELETE FROM demo1 WHERE id = '$id'";

    $conn->query($sqlQuery);

    $_SESSION["msg"] = "data deleted successfully";
    header("location:index.php");
?>