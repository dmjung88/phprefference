<?php

include_once "../functions/db.php";
$db = connection();

$id = intval($_POST['id']);
$query = "SELECT * FROM `member2` WHERE id = '$id'";

$result = mysqli_query($db,$query);
$data = mysqli_fetch_assoc($result);

if($data) {
    echo json_encode(['status' => 'success', $data]);
} else {
    echo json_encode(['status' => 'failed', 'message' => '게시글없음!']);
}

?>