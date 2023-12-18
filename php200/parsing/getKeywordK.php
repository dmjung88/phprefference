<?php
/*테이블에 N사 포털과 다음 포털사이트 1위검색어를 수집하여 입력
cURL라이브러리 필요 BUT XAMPP에 내장
*/
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $curl = curl_init();
    //curl을 초기화하고 반환된 핸들정보를 변수에 대입
    $url = 'https://www.daum.net';
    //코드를 가져올사이트
    curl_setopt($curl, CURLOPT_URL, $url);
    //curl옵션 설정 CURLOPT_URL URL을 설정함을 의미
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //CURLOPT_RETURNTRANSFER 가져온 데이터를 문자열로 반환
    $htmlCode = curl_exec($curl);
    //curl을 실행하고 반환받은 값을 변수 htmlCode에 대입
    curl_close($curl);
    //curl을 종료

    $pattern = '/span class=\"txt_issue\"\>(.*)\</';
    //현재 이글을 작성중인 시점에서 1위키워드 표시태그
    preg_match($pattern, $htmlCode, $matchKeywords);
    $keyword = $matchKeywords[1];
    $pattern = '/\>(.*)\</';
    preg_match($pattern, $keyword, $matchKeywords);
    $keyword = $matchKeywords[1];
    //var_dump() Undefined offset 은 어떤 배열에서 정의되어 있지 않은 값을 호출하려 할 때 발생
    echo '현재 K사의 실시간 검색 1위 키워드 : '.$keyword;
?>