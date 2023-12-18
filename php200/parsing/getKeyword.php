<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    function getMediaSource($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $htmlCode = curl_exec($curl);
        curl_close($curl);
        return $htmlCode;
    }

    function keywordCrawling($portal){
        global $dbConnect;
        switch ($portal) {
            case 'naver':
                $portalHtmlCode = getMediaSource('https://www.naver.com');
                $pattern = '/span class=\"ah_k\"\>(.*)\</';
                preg_match($pattern, $portalHtmlCode, $matchKeywords);
                $keyword = $matchKeywords[1];
                break;
            case 'daum':
                $portalHtmlCode = getMediaSource('https://www.daum.net');
                $pattern = '/span class=\"txt_issue\"\>(.*)\</';
                preg_match($pattern, $portalHtmlCode, $matchKeywords);
                $keyword = $matchKeywords[1];
                $pattern = '/>(.*?)</';
                preg_match($pattern, $keyword, $matchKeywords);
                $keyword = $matchKeywords[1];
                break;
            default :
                exit;
                break;
        }

        $regTime = time();
        $sql = "INSERT INTO realtimekeyword (keyword, media, regTime) ";
        $sql .= "VALUES ('{$keyword}', '{$portal}', {$regTime})";
        $dbConnect->query($sql);
    }

    keywordCrawling('naver');
    keywordCrawling('daum');
?>