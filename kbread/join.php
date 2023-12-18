<?php
  $uid = $_POST['uid'];
  $uname = $_POST['uname'];
  $uphone = $_POST['uphone'];
  $upass = $_POST['upass'];

  //mysql 접속
  $url='localhost';
  $id='test';
  $pass='1111';
  $db='testdb';
  $conn=mysqli_connect($url,$id,$pass,$db);

//   if($conn)
//   echo "<h1>연결성공!</h1><br>";
// else
// echo "<h1>연결실패ㅠ</h1>";

$sql = "insert into kbread(uid,uname,uphone,upass) values('$uid', '$uname','$uphone','$upass')";
//2. 쿼리 날리기(테이블에 있는 모든 데이터 가지고 오기)
    mysqli_query($conn, $sql); 
    
   echo "<script>데이터가 성공적으로 추가되었습니다!</script>";
   
   mysqli_close($conn);
  //  echo $uid."<br>";
  // echo $uname."<br>";
  // echo $uphone."<br>";
  // echo $upass."<br>";
   
?>
<meta http-equiv="refresh" content="0; url=list.php">