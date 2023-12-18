<?php 
    include('inc/db.php');
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $query = "DELETE FROM MEMBER2 WHERE id = '$id'";

    $result = mysqli_query($db,$query);
    if($result) {
        echo "YES";
    } else {
        echo "NO";
    }
?>