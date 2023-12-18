<?php require_once "../class.php";
if(!empty($_POST)){
	$user = new User;
	$user->insert($_POST['first'],$_POST['last'],$_POST['work'],$_POST['email']);
}
