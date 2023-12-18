<?php

include_once('inc/class.php');
$user_function = new Userfunction();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $data['id'] = $id;
    $select_pre = $user_function->select_edit("member2", $data);
    if($select_pre){
        $json['status'] = 0;
        $json['forename'] = $select_pre['forename'];
        $json['surname'] = $select_pre['surname'];
        $json['email'] = $select_pre['email'];
        $json['msg'] = "Success";
    }else {
        $json['status'] = 1;
        $json['msg'] = "Fail";
    }
    echo json_encode($json);
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $primary_key['id'] = filter_input(INPUT_POST, 'dataval', FILTER_VALIDATE_INT);

    $field_val['forename'] = $user_function->htmlvalidation($_POST['username']);
    $field_val['email'] = $user_function->htmlvalidation($_POST['email']);
    $field_val['surname']= $user_function->htmlvalidation($_POST['country']);
    $field_val['password']= $user_function->htmlvalidation($_POST['bod']);
    $update = $user_function->update($field_val, $primary_key);

    if($update){
        $json['status'] = 101;
        $json['msg'] = "Data 수정성공";
    } else {
        $json['status'] = 102;
        $json['msg'] = "수정실패";
    }
    echo json_encode($json);

}

