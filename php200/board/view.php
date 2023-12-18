<?php //조회
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    if(isset($_GET['boardID']) && (int) $_GET['boardID'] > 0){
        $boardID = $_GET['boardID'];
        $sql = "SELECT b.title, b.content, m.nickname, b.regTime FROM board b ";
        $sql .= "JOIN member m ON (b.memberID = m.memberID) ";
        $sql .= "WHERE b.boardID = {$boardID}";
        $result = $dbConnect->query($sql);

        if( $result ) {
            $contentInfo = $result->fetch_array(MYSQLI_ASSOC);
            echo "제목 : " . $contentInfo['title'] . "<br>";
            echo "작성자 : " . $contentInfo['nickname'] . "<br>";
            $regDate = date("Y-m-d h:i");
            echo "게시일 : {$regDate}<br><br>";
            echo "내용 <br>";
            echo $contentInfo['content'].'<br>';
            echo "<a href='/php200/board/list.php'>목록으로 이동</a>";

        } else {
            echo "잘못된 접근입니다.";
            exit;
        }
    } else {
        echo "잘못된 접근입니다.";
        exit;
    }
?>