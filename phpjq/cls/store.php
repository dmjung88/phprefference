<?php

include_once('inc/class.php');
$user_function = new Userfunction();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $field_val['forename'] = $user_function->htmlvalidation($_POST['username']);
    $field_val['email'] = $user_function->htmlvalidation($_POST['email']);
    $field_val['surname']= $user_function->htmlvalidation($_POST['country']);
    $field_val['password']= $user_function->htmlvalidation($_POST['bod']);

    $insert = $user_function->insert("member2", $field_val);
	if($insert){
        $json['status'] = 101;
        $json['msg'] = "Data Successfully 입력";
    } else {
        $json['status'] = 102;
        $json['msg'] = "입력실패";
    }
    echo json_encode($json);
}