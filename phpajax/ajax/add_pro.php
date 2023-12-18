<?php

  include('db.php');

if(isset($_POST['name'])) {

    $task_name = $_POST['name'];
    $task_description = $_POST['description'];
    $query = "INSERT into board(title, content) VALUES ('$task_name', '$task_description')";
    $result = mysqli_query($db, $query);

//  echo $result ? 'true' : mysqli_error($db); 

//   if(!$result) {
//     die(mysqli_errno($db) .' : '. mysqli_error($db));
//   }


    //echo !$result ? mysqli_errno($db).mysqli_error($db) :'true'; 

    if (mysqli_error($db)) {
        echo mysqli_errno($db).' 원인 : '.mysqli_error($db);
        exit();
    } 

}

?>