<?php //임의의 데이타 랜덤입력 페이지
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    for($i = 1; $i <= 165; $i++){
        $time = time();
        $sql = "INSERT INTO board (memberID, title, content, regTime) ";
        $sql .= "VALUES (1, '{$i}번째 제목', '{$i}번째 내용', {$time})";
        $result = $dbConnect->query($sql);
        if($result){
            echo "{$i}번째 데이터 입력완료";
        }else{
            echo "{$i}번째 데이터 입력실패";
        }
        echo '<br>';
    }
?>