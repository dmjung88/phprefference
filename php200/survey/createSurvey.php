<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $sql = "CREATE TABLE survey(";
    $sql .= "surveyID int(10) unsigned NOT NULL AUTO_INCREMENT,";
    $sql .= "memberID int(10) unsigned DEFAULT NULL,";
    $sql .= "kind enum(";
    $sql .= "'offlineStore','onlineStore','website','friends',";
    $sql .= "'academy','noMemory','etc'),";
    $sql .= "regTime int(10) unsigned DEFAULT NULL,";
    $sql .= "PRIMARY KEY (surveyID)";
    $sql .= ")CHARSET=utf8";

    $res = $dbConnect->query($sql);

    if ($res) {
        echo "테이블 생성 완료";
    } else {
        echo "테이블 생성 실패";
    }
?>