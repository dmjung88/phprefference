<?php require_once "../class.php";
    if(empty($_POST['id'])){
        die('데이터 없음');
    }else {
        $user = new User;
        $user->update($_POST['id'],$_POST['first'],$_POST['last']);
    }