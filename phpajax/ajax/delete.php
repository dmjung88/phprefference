<?php

include('db.php');

if(isset($_POST['id'])) {
  $id = mysqli_real_escape_string($db,$_POST['id']);
  $query = "DELETE FROM `board` WHERE UID = '$id'"; 
  $result = mysqli_query($db, $query);

  echo "삭제성공";  

}

?>
