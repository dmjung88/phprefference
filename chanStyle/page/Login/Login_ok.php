<?php

header('Content-Type: text/html; charset=utf-8'); //인코딩 타입을 utf-8로 설정

$db = new mysqli("localhost", "root", "wjddncks!", "chanstyle"); // $db에 mysql을 연결
$db->set_charset("utf8"); // db문자열을 utf-8로 인코딩

// 연결 확인
if($db->connect_errno) {
    echo '[DB연결실패] :' .$db->connect_error.'';
} else {
}

function mq($sql)
{
    global $db; // global은 외부에서 선언된 $sql을 함수 내에서 쓸 수 있도록 해줌
    return $db->query($sql);
}

if(isset($_POST["remember-me"])){
    $duration = 7 * 24 * 60 * 60;
    ini_set('session.gc_maxlifetime', $duration);
    session_set_cookie_params($duration);
}
session_start();
// Post로 바다온 아이디와 비밀번호가 비어있다면 알림창을 띄우고 전 페이지로 돌아감
if($_POST["userid"] == "" || $_POST["userpwd"] == "") {
    echo '<script> alert("아이디와 패스워드를 모두 입력하세요."); history.back(); </script>';
} else {
    $password = $_POST['userpwd'];
    $sql = mq("select * from userInfo where id='".$_POST['userid']."'");
    $member = $sql->fetch_array();
    $hash_pw = $member['pw']; // hash_pw에 POST로 받아온 아이디열의 비밀번호를 저장한다.

    if(password_verify($password, $hash_pw)) {  // 만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운 후 main으로 이동
        $_SESSION['userid'] = $member["id"];
        $_SESSION['userpw'] = $member["pw"];
        $_SESSION['username'] = $member['name'];
        echo "<script>location.href='/ChanStyle/index.php';</script>";
    } else {
        echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
    }
}
/*
   mysql에서 insert를 할 경우 가끔 정확하게 sql문을 적었는데 오류가 나는 경우가 있습니다. 그럴때 보면
둘 다 사용하려는 경우 먼저 htmlspecialchars를 사용한 다음 mysql_real_escape_string을 사용하고 그 반대는 사용하지 마십시오.
싱글쿼터(') 나 더블쿼터(")가 들어가서 안되는 경우가 있는데 그럴때 addslashes()를 사용하면 싱글쿼터랑 더블쿼터 앞에 \를 추가해 주는 함수입니다.

sql injection 같은 상황에 대비해서 특수문자의 경우는 처리해주는게 좋습니다.



stripslashes는 addslashes의 반대 기능입니다.

htmlspecialchars 같은 경우는 특정한 특수문자를 html 엔티티로 변환해주는 함수입니다.

addslashes 함수로 sql injection 방지처리를 한다면 htmlspecialchars로 xss공격을 방지 할 수 있습니다.
*/
?>
