<?php

  include('db.php');
  
    if(isset($_POST['id'])) {
        $task_name = mysqli_real_escape_string($db,$_POST['name']); 
        $task_description = mysqli_real_escape_string($db,$_POST['description']);
        $id = mysqli_real_escape_string($db,$_POST['id']);
        $query = "UPDATE board SET title = '$task_name', content = '$task_description' WHERE uid = '$id'";
        $result = mysqli_query($db, $query);
        
        //echo !$result ? mysqli_errno($db).mysqli_error($db) :'true'; 

    echo "수정 성공";  
  
  }
  