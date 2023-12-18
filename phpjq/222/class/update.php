<?php

include_once "../functions/db.php";
$db = connection();

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$forename = clean($_POST['fname']);
$surname = clean($_POST['lname']);

$sql = "UPDATE MEMBER2 SET `forename` = '$forename' , `surname`='$surname' WHERE ID='$id'";
$result =mysqli_query($db,$sql);
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Data 업데이트 성공!']);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'Data Update failed!']);
}


?>

