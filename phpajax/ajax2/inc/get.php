<?php require_once "../class.php";
if(isset($_GET['id'])){
    $user = new User;
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $data = $user->get_row($id);
    echo json_encode($data);
}