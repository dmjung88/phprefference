<?php 
    include_once "./connection.php";
	$id = esc($_POST["car_id"]);

    $sql = "DELETE FROM MEMBER2 WHERE ID = '$id'";
    $result = mysqli_query(connection(),$sql);
    if (!$result){
        die("Query Failed ".mysqli_error(connection()));
    }