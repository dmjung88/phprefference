<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $title = $_POST['title'];
    $content = $_POST['content'];

    if($title != null && $title != ''){
        $title = $dbConnect->real_escape_string($title);
    } else {
        echo "제목을 입력하세요.";
        echo "<a href='./writeForm.php'>작성 페이지로 이동</a>";
        exit;
    }

    if($content != null && $content != ''){
        $content = $dbConnect->real_escape_string($content);
    } else {
        echo "내용을 입력하세요.";
        echo "<a href='./writeForm.php'>작성 페이지로 이동</a>";
        exit;
    }

    $memberID = $_SESSION['memberID'];

    $regTime = time();

    $sql = "INSERT INTO board (memberID, title, content, regTime) ";
    $sql .= "VALUES ({$memberID},'{$title}','{$content}',{$regTime})";//int 변수는 '',''없이 둘다 가능
    $result = $dbConnect->query($sql);

    if($result){
        echo "저장 완료";
        echo "<a href='./list.php'>게시글 목록으로 이동</a>";
        exit;
    } else {
        echo "저장 실패 - 관리자에게 문의";
        echo "<a href='./list.php'>게시글 목록으로 이동</a>";
        exit;
    }
?>