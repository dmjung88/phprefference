<?php

    require '../config/db_config.php';
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $sql = "DELETE FROM `users` WHERE user_id = '".$id."'";
    $result = $conn->query($sql);
    echo json_encode([$id]);
?>