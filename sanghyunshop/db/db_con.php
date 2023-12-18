<?php
		$db_id = "user1";
		$db_pw = "12345";
		$db_name = "sample";
		$db_domain = "localhost";
		$con = mysqli_connect($db_domain,$db_id,$db_pw,$db_name);

		header('Content-Type: text/html; charset=utf-8'); //인코딩 타입을 utf-8로 설정
		$con->set_charset("utf8"); // db문자열을 utf-8로 인코딩
?>
