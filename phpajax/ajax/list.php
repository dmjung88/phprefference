<?php

  include('db.php');

  $query = "SELECT * from BOARD";
  $result = mysqli_query($db, $query);

//   echo $result ? 'true' : mysqli_errno($db) .' : '. mysqli_error($db); 

//   if(!$result) {
//     die(mysqli_error($db));
//   }
    $json = array();
    while($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'name' => $row['title'],
            'description' => $row['content'],
            'id' => $row['uid']
        );
    }
    echo json_encode($json);
