<?php

    include_once "../functions/db.php";
    $db = connection();

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    $sql = "DELETE FROM `MEMBER2` WHERE id ='$id'";
    $result = mysqli_query($db, $sql);
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => '삭제성공!']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Data Delete failed!']);
    }

?>