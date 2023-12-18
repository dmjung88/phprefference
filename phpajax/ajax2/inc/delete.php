<?php require_once "../class.php";
    if(empty($_POST['id'])){
        die("Not found");
    }else {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $user = new User;
        $user->delete($id);	
    }