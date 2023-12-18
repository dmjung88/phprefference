<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $sql = "CREATE TABLE realtimekeyword(";
    $sql .= "realtimekeywordID INT UNSIGNED AUTO_INCREMENT,";
    $sql .= "keyword VARCHAR(20),";
    $sql .= "media ENUM('naver','daum'),";
    $sql .= "regTime INT UNSIGNED,";
    $sql .= "PRIMARY KEY(realtimekeywordID))";
    $sql .= "CHARSET=utf8";

    $result = $dbConnect->query($sql);

    if ($result) {
        echo "테이블 생성 완료";
    } else {
        echo "테이블 생성 실패";
    }
?>