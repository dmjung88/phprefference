<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php'; //세션 시작
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';//비로그인시 홈으로
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';//DB연결
?>
<!doctype html>
<html>
<head>
<title>게시물 목록</title>
</head>
<body>
<a href="./writeForm.php">글작성하기</a>
<a href="../signIn/signOut.php">로그아웃</a>
<table>
    <thead>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>게시일</th>
    </thead>
    <tbody>

<?php
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    }else{
        $page = 1;
    }

    $numView = 20;

    $firstLimitValue = ($numView * $page) - $numView;

    $sql = "SELECT b.boardID, b.title, m.nickname, b.regTime FROM board b ";
    $sql .= "JOIN member m ON (b.memberID = m.memberID) ORDER BY boardID ";
    $sql .= "DESC LIMIT {$firstLimitValue}, {$numView}";

    $result = $dbConnect->query($sql);

    if( $result ) {
        $dataCount = $result->num_rows;

        if($dataCount > 0){
            for($i = 0; $i < $dataCount; $i++){
                $memberInfo = $result->fetch_array(MYSQLI_ASSOC); //foreach $result as $memberInfo
                echo "<tr>";
                echo "<td>".$memberInfo['boardID']."</td>";
                echo "<td><a href='/php200/board/view.php?boardID=";
                echo "{$memberInfo['boardID']}'>";
                echo $memberInfo['title'];
                echo "</a></td>";
                echo "<td>{$memberInfo['nickname']}</td>";
                echo "<td>".date('Y-m-d H:i', $memberInfo['regTime'])."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
        }

    }
?>
    </tbody>
</table>

<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/board/nextPageLink.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/board/searchForm.php';
?>
</body>
</html>
