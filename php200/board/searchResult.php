<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $searchKeyword = $dbConnect->real_escape_string($_POST['searchKeyword']);
    $searchOption = $dbConnect->real_escape_string($_POST['option']);

    if($searchKeyword == '' || $searchKeyword == null){
        echo "검색어가 없습니다.";
        exit;
    }

    switch ($searchOption){ //필요X
        case 'title': //case 'VALUE'
        case 'content':
        case 'tandc':
        case 'torc':
            break;
        default :
            echo "검색 옵션이 없습니다.";
            exit;
            break;
    }

    $sql = "SELECT b.boardID, b.title, m.nickname, b.regTime FROM board b ";
    $sql .= "JOIN member m ON (b.memberID = m.memberID) ";

    switch ($searchOption) {
        case 'title':
            $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";
            break;
        case 'content':
            $sql .= "WHERE b.content LIKE '%{$searchKeyword}%'";
            break;
        case 'tandc':
            $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";
            $sql .= " AND ";
            $sql .= "b.content LIKE '%{$searchKeyword}%'";
            break;
        case 'torc':
            $sql .= "WHERE b.title LIKE '%{$searchKeyword}%'";
            $sql .= " OR ";
            $sql .= "b.content LIKE '%{$searchKeyword}%'";
            break;
    }

    $result = $dbConnect->query($sql);
    if($result) {
        $dataCount = $result->num_rows;
    }else{
        echo "오류 발생 - 관리자 문의";
        exit;
    }
?>
<!doctype html>
<html>
<head>
<title>검색 결과</title>
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
    if($dataCount > 0){
        for($i = 0; $i < $dataCount; $i++){
            $memberInfo = $result->fetch_array(MYSQLI_ASSOC);
            echo "<tr>";
            echo "<td>".$memberInfo['boardID']."</td>";
            echo "<td><a href='./view.php?boardID={$memberInfo['boardID']}'>";
            echo "{$memberInfo['title']}</a></td>";
            echo "<td>".$memberInfo['nickname']."</td>";
            echo "<td>".date('Y-m-d H:i', $memberInfo['regTime'])."</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>{$searchKeyword}를 포함하는 게시글이 없습니다.</td></tr>";
    }
?>
    </tbody>
</table>
</body>
</html>