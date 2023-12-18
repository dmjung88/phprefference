<?php

include_once "../functions/db.php";
$db = connection();

$id = intval($_POST['id']);
$sql = "SELECT * FROM `MEMBER2` WHERE Id = '$id'";
$result = mysqli_query($db,$sql);
$data = mysqli_fetch_assoc($result);
if ($data) {
    echo json_encode(['status' => 'success', $data]);
} else {
    echo json_encode(['status' => 'failed', 'message' => '개인정보 데이터가 없어!']);
}
