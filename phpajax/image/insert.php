<?php
require_once ('inc/db.php');

$upload_dir = 'images/';

if(isset($_POST['insert'])) {
    $title        = clean($_POST['title']);
    $content      = clean($_POST['content']);
    $image_name   = $_FILES['image']['name']; //파일의 원래 이름
    $imgTmp       = $_FILES['image']['tmp_name']; //파일 임시 저장소. 
    //$imgSize    = $_FILES['image']['size']; 업로드된 파일의 바이트로 표현한 크기. 
    //$_FILES['이름']['type'] 파일의 형식. 예를 들면 "image/gif". 
    //$_FILES['이름']['error'] 에러 코드
    
    $imgExt = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    $allowExt  = array('jpeg', 'jpg', 'png', 'gif');

    $userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

    if(in_array($imgExt, $allowExt)){
        //$location     = "uploads/".$userPic;
        move_uploaded_file($imgTmp ,$upload_dir.$userPic);
    }else{
        die('이미지 확장자 아님');
    }

    $query = "INSERT INTO board (title,content,image) VALUES ('".escape($title)."', '".escape($content)."','$userPic')";

    $result = mysqli_query($db,$query);

    if($result == true) {
        header("Location:index.php");
    } else {
        die(mysqli_errno($db) . mysqli_error($db));
    }

} //endPost
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>인서트</title>
</head>
<body>
<div class="container">

<div class="jumbotron text-center">
    <h2>Crud Application Using PHP</h2>
</div>
<br>
<div class="row">
<div class="col-md-12">

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">타이틀:</label>
    <input type="text" name="title" class="form-control" placeholder="타이틀">
</div>
<div class="form-group">
    <label for="name">컨텐츠:</label>
    <input type="text" name="content" class="form-control" placeholder="컨텐츠">
</div>
<div class="form-group">
    <label for="name">Image:</label>
    <input type="file" accept="image/*" class="btn btn-primary" name="image" class="form-control" placeholder="Enter email">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="작성" name="insert">
</div>
</form>
</div>
</div>

</div>
</body>
</html>