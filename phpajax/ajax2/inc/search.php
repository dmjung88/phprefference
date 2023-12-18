<?php require_once "../class.php";
if(isset($_POST['q'])){
    $q = $_POST['q'];
    $q = "%$q%";
    //$q = "%".$q."%";
    $user = new User;
    $data = $user->search($q);
	echo $data;
}