<?php

include_once "../functions/db.php";
$db = connection();

$forename = esc($_POST['fname']);
$surname = esc($_POST['lname']);
$email = esc($_POST['email']);
$password = esc($_POST['password']);
$gender = esc($_POST['gender']);
$dob = esc($_POST['dob']);
$education = esc($_POST['education']);
$address = esc($_POST['address']);
$bio = esc($_POST['bio']);


$query = "INSERT INTO `MEMBER2` (`forename`, `surname`, `email`, `password`) Values ('$forename', '$surname', '$email', '$password')";

$result = mysqli_query($db, $query);
if($result){
    echo json_encode(['status' => 'success', 'message' => 'Data Inserted Successfully!']);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'Data Inserted failed!']);
}
