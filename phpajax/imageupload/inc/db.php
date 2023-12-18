<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$db = mysqli_connect($host, $username, $password, $dbname);
if (!$db) {
	die("DB에러 : " . mysqli_connect_error());
}
header('Content-Type: text/html; charset=utf-8'); //인코딩 타입을 utf-8로 설정
$db->set_charset("utf8"); // db문자열을 utf-8로 인코딩
?>
