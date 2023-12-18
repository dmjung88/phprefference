<?php

    require '../config/db_config.php';

    $id = intval($_REQUEST['id']);
    $forename = mysqli_real_escape_string($conn,$_POST['title']);
    $surname = mysqli_real_escape_string($conn,$_POST['description']);

    $sql = "UPDATE `MEMBER2` SET forename = '$forename' ,surname= '$surname' WHERE ID = '$id'";
    $result = $conn->query($sql);
    $sqlOne = "SELECT * FROM `MEMBER2` WHERE id = '".$id."'"; 
    $resultOne = $conn->query($sqlOne);
    $data = $resultOne->fetch_assoc();
    echo json_encode($data);