<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $email = $_POST['userEmail'];
    $pw = $_POST['userPw'];

    function goSignInPage($alert){
        echo $alert.'<br>';
        echo "<a href='./signInForm.php'>로그인폼으로 이동</a>";
        return;
    }

    //유효성 검사
    //이메일 검사
    if(!filter_Var($email, FILTER_VALIDATE_EMAIL)){
        goSignInPage('올바른 이메일이 아닙니다.');
        exit;
    }

    //비밀번호 검사
    if($pw == null || $pw == '') {
        goSignInPage('비밀번호를 입력해 주세요.');
        exit;
    }

    $pw = sha1('php200'.$pw);
  //decode : 회원가입할때 암호화한 비밀번호와 같은값이 되도록 같은 방법으로 입력받은 비밀번호를 암호화

    $sql = "SELECT email, nickName, memberID FROM member ";
    $sql .= "WHERE email = '{$email}' AND pw = '{$pw}'";
    $result = $dbConnect->query($sql); //객체지향
    //$result=mysqli_query($dbConnect, $sql);

    if($result){
        if($result->num_rows == 0){
            goSignInPage('로그인 정보가 일치하지 않습니다.');
            exit;
        } else {
            $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
            $_SESSION['memberID'] = $memberInfo['memberID'];
            $_SESSION['nickName'] = $memberInfo['nickname'];
            Header("Location:../index.php");
        }
    }
?>