<?php include_once('inc/db.php'); ?>
<?php 
$forename = filter_input(INPUT_POST, 'forename', FILTER_SANITIZE_SPECIAL_CHARS);
$surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //FILTER_SANITIZE_EMAIL

$chk_email = "SELECT email FROM member2 WHERE email ='$email'";
$result = mysqli_query($db,$chk_email);
if(mysqli_num_rows($result) > 0)  echo "Email 중복";

$query = "INSERT INTO member2(`forename`,`surname`,`email`) VALUES('".$forename."','".$surname."','".$email."')";
$res = mysqli_query($db,$query);
echo $res ? "입력 성공" : "실패";
?>