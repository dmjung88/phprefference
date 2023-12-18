<?php
$idx = $_GET['idx'];    
$userid = $_POST['userid'];
$pass = $_POST['pass'];

include('./db_conn.php');

if($userid =="admin" and $pass =="1111"){
    
    $sql = "delete from kbread where id = $idx";
    mysqli_query($conn, $sql);

    echo "<script>alert('삭제가 완료되었습니다');(-1)</script>";
    mysqli_close($conn);
}
else {
    
    echo "<script>alert('비밀번호가 일치하지 않습니다');history.go(-1)</script>";
}
?>

 <meta http-equiv="refresh" content="1;list.php">  