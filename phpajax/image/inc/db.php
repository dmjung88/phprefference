<?php

define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','test');

$db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

header('Content-Type: text/html; charset=utf-8'); //인코딩 타입을 utf-8로 설정
$db->set_charset("utf8"); // db문자열을 utf-8로 인코딩

function escape($string)
{
    global $db;    
    return mysqli_real_escape_string($db,$string);
}

function clean($string)
{
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlentities($string);

	return $string;
}

?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
