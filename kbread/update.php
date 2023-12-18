<?php
 $uid = $_POST['uid'];
 $uname = $_POST['uname'];
 $uphone = $_POST['uphone'];
 $upass = $_POST['upass'];
 $idx = $_POST['idx'];
include('./db_conn.php');

$sql = "update kbread set uid = '$uid', uname = '$uname' , uphone = '$uphone', upass  = '$upass' where id = $idx";
mysqli_query($conn, $sql);
echo "<script>alert('수정이 완료되었습니다.');</script>";

mysqli_close($conn);
?>
<meta http-equiv="refresh" content="0.5;list.php"> 