<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $email = $_POST['userEmail'];
    $nickName = $_POST['userNickName'];
    $pw = $_POST['userPw'];
    $birthYear = (int) $_POST['birthYear'];
    $birthMonth = (int) $_POST['birthMonth'];
    $birthDay = (int) $_POST['birthDay'];

    function goSignUpPage($alert){
        echo $alert.'<br>';
        echo "<a href='./signUpForm.php'>회원가입폼으로 이동</a>";
        return;
    }

    //유효성 검사
    //이메일 검사
    //해당 이메일 값이 올바르다면 true를, 올바르지 않다면 false를 리턴한다.
    //fliter_var는 값 유효성검사 URL IP	INT FLOAT 도가능  
    if(!filter_Var($email, FILTER_VALIDATE_EMAIL)){
        goSignUpPage('올바른 이메일이 아닙니다.');
        exit;
    }

    //한글로 구성되어있는지 정규식 검사
    $nickNameRegPattern = '/^[가-힣]{1,}$/';
    if (!preg_match($nickNameRegPattern, $nickName, $matches)) {
        var_dump($matches);//반환값 : 매칭에 성공하면 1, 실패하면 0이 반환
        goSignUpPage('닉네임은 한글로만 입력해 주세요.');
        exit;
    }

    //비밀번호 검사
    if($pw == null || $pw == ''){
        goSignUpPage('비밀번호를 입력해 주세요.');
        exit;
    }

    $pw = sha1('php200'.$pw);
     //encode : 문자열을 암호화 하는 함수이며 입력한 비밀번호 앞에 사용한
    //임의적으로 비밀번호에 값을 더하여(php200) 실제 입력한 값과 다르게 변경

    //생년 검사 String 을 던지면 0반환
    if($birthYear == 0) {
        goSignUpPage('생년을 정확히 입력해 주세요.');
        exit;
    }

    //생월 검사
    if($birthMonth == 0) {
        goSignUpPage('생월을 정확히 입력해 주세요.');
        exit;
    }

    //생일 검사
    if($birthDay == 0) {
        goSignUpPage('생일을 정확히 입력해 주세요.');
        exit;
    }

    $birth = $birthYear.'-'.$birthMonth.'-'.$birthDay;

    //이메일 중복 검사
    $isEmailCheck = false;

    $sql = "SELECT email FROM member WHERE email = '{$email}'";
    $result=mysqli_query($dbConnect, $sql);

    if( $result ) {
        $count = $result->num_rows; //전체 레코드수 int 반환
        if($count == 0){
            $isEmailCheck = true;
        } else {
           
            goSignUpPage( "이미 존재하는 이메일 입니다. ");
            exit;
        }
    } else {
        echo "에러발생 : 관리자 문의 요망";
        exit;
    }


    //닉네임 중복 검사
    $isNickNameCheck = false;

    $sql = "SELECT nickName FROM member WHERE nickname = '{$nickName}'";
    $result = mysqli_query($dbConnect,$sql);

    if( $result ) {
        $count = $result->num_rows;
        if($count == 0){
            $isNickNameCheck = true;
        } else {
            goSignUpPage('이미 존재하는 닉네임 입니다.');
            exit;
        }
    } else {
        echo "에러발생 : 관리자 문의 요망";
        exit;
    }

    if ($isEmailCheck == true && $isNickNameCheck == true) {
        $regTime = time();
        $sql = "INSERT INTO member(email, nickname, pw, birthday, regTime)";
        $sql .= "VALUES('{$email}', '{$nickName}', '{$pw}',";
        $sql .= "'{$birth}', {$regTime})";
        $result = $dbConnect->query($sql);

        if ($result) {
            $_SESSION['memberID'] = $dbConnect->insert_id; 
            //insert_id : DB에 입력후 PK 컬럼의 값 받아올때 사용.
            //INSERT 명령으로 입력된 바로 그값의 PK(Primary Key)를 가져오는 명령을 수행합니다.
            $_SESSION['nickName'] = $nickName;
            Header("Location:../index.php");
        } else {
            echo '회원가입 실패 - 관리자에게 문의';
            exit;
        }
    } else {
        goSignUpPage('이메일 또는 닉네임이 중복값입니다.');
        exit;
    }
?>