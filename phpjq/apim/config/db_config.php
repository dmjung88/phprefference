<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function esc($string)
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