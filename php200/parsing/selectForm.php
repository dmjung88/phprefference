<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $sql = "SELECT regTime FROM realtimekeyword";
    $result = $dbConnect->query($sql);

    $count = $result->num_rows;
    //var_export($count);
    
    //검색 가능한 날짜 수집
    $dateList = array();
    
    for($i = 0; $i < $count; $i++){
        $data = $result->fetch_array(MYSQLI_ASSOC);
        $date = date('Y-m-d h:i:s', $data['regTime']);
        array_push($dateList, $date);
    //array_push ([배열], [추가할 값]) 함수는 사용자가 지정한 배열(array)에 새로운 값을 넣어 주는 함수
    }

    //array_unique는 배열의 중복값을 없애는 함수
    $dateList = array_unique($dateList);
    print_r($dateList);
?>
<!doctype html>
<html>
<head>
<title>실시간 검색어 리스트 선택 폼</title>
</head>
<body>
<h1>포털 사이트와 날짜를 선택하세요.</h1>
<form name="realtimekeyword" method="post" action="view.php">
    <select name="media" required>
        <option value="naver">네이버</option>
        <option value="daum">다음</option>
    </select>
    
    <select name="date">
<?php
    foreach($dateList as $dl){
?>
        <option value="<?=$dl?>"><?=$dl?></option>
<?php
    
    }
?>
    </select>
    <input type="submit" value="검색어 보기" />
</form>
</body>
</html>