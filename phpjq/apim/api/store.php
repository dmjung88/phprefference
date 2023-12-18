<?php

require '../config/db_config.php';

    $forename = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $surname = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO `MEMBER2`(`FORENAME`,`SURNAME`)VALUES('$forename','$surname')";
    $result = $conn->query($sql);
    $sqlAll = "SELECT * FROM MEMBER2 Order by id desc LIMIT 1"; 
    $resultAll = $conn->query($sqlAll);
    $newData = $resultAll->fetch_assoc();
    echo json_encode($newData);
?>