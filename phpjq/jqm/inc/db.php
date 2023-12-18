<?php 
$host="localhost";
$user="root";
$db_password="";
$db_name="test";

$db= mysqli_connect($host,$user,$db_password,$db_name);
if(!$db)  print mysqli_connect_error();

function escape($string)
{
	$string = trim($string);
	$string = stripcslashes($string);
	$string = htmlentities($string);

	return $string;
}

function html_escape(string $string): string
{
	return htmlspecialchars($string, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
}

?>