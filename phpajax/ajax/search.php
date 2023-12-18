<?php

include('db.php');

$search = mysqli_real_escape_string($db,$_POST['search']);

if(!empty($search)) {
    $query = "SELECT * FROM `board` WHERE title LIKE '%$search%' OR content LIKE '%$search%' ";
    $result = mysqli_query($db, $query);

    if(!$result) {
        die(mysqli_errno($db).' : '.mysqli_error($db));
    }
    $json = array();
    while($board = mysqli_fetch_array($result)) {
        $json[] = array(
            'name' => $board['title'],
            'description' => $board['content'],
            'id' => $board['uid']
        );
        echo json_encode($json);
    }
}