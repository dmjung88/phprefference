<?php

include_once('inc/class.php');
$user_function = new Userfunction();

$data['id'] = filter_input(INPUT_POST, 'delete_id', FILTER_VALIDATE_INT);
$delete_rec = $user_function->delete($data);

if($delete_rec){
    $json['status'] = 0;
    $json['msg'] = "삭제 성공";
} else {
    $json['status'] = 1;
    $json['msg'] = "삭제 실패";
}
echo json_encode($json);