<?php

$uid = $_POST['uid'];
$upass = $_POST['upass'];


$url='localhost';
$id='test';
$pass='1111';
$db='testdb';
$conn=mysqli_connect($url,$id,$pass,$db);

$sql = "select * from kbread where upass = '{$upass}'";
$result=mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);



for($i=0; $i<$count; $i++){
 $re=mysqli_fetch_row($result);



if ($re[1] === $uid && $re[4] === $upass) {
    // 로그인 성공
    // 세션에 id 저장
    // session_start();
    // $_SESSION['userId'];
    // print_r($_SESSION);
    // echo $_SESSION['userId'];
    
?>
    <script>
        alert("로그인에 성공하였습니다.")
        location.href = "index.php";
    </script>

<?php
} else {
    // 로그인 실패 
?>
    <script>
        alert("로그인에 실패하였습니다.")
        location.href = "loginform.php";
    </script>
<?php
}
}
?>
