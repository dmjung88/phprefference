<?php

include('db.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
  
    $query = "SELECT * from `board` WHERE Uid = {$id}";
    $result = mysqli_query($db, $query);
    if(!$result) {
        die(mysqli_errno($db).' : '.mysqli_error($db));
    }

    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'name' => $row['title'],
            'description' => $row['content'],
            'id' => $row['uid']
        );
        echo json_encode($json[0]);
    }
}