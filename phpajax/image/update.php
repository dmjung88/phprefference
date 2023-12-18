<?php
    include_once 'inc/db.php';

    if(isset($_GET['update'])){ //php?update=$id
        $id = filter_input(INPUT_GET, 'update', FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM board WHERE UID = $id";
        $result = mysqli_query($db,$sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){          
                $title  = $row['title'];
                $content = $row['content'];
                $image = $row['image'];
            }
        }
    } //endGET
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title        = clean($_POST['title']);
        $content      = clean($_POST['content']);
        $image_name   = $_FILES['image']['name'];
        $imgTmp       = $_FILES['image']['tmp_name'];

        //이미지 삭제
        $imgRm = "SELECT * FROM BOARD WHERE UID = $id";    
        $rs = mysqli_query($db,$imgRm);

        while($row = mysqli_fetch_array($rs)){
             $img= $row['image'];
             unlink("images/".$img);
        }
        //삭제 끝

        $imgExt = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        $allowExt  = array('jpeg', 'jpg', 'png', 'gif');
    
        $userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
    
        if(in_array($imgExt, $allowExt)){
            $location     = "images/".$userPic;
            move_uploaded_file($imgTmp ,$location);

        }else{
            die('이미지 확장자 아님');
 
        }
        //이미지 저장 끝

        $sql = "UPDATE BOARD SET TITLE = '$title', CONTENT = '$content' ,IMAGE = '$userPic' WHERE UID = '$id'";
        $result = mysqli_query($db, $sql);
        if($result) {
            header('location:index.php');
        } else {
            die(mysqli_errno($db).mysqli_error($db));
        }
    } //endPOST
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>업데이트</title>
</head>
<body>
<div class="container">
    <div class="jumbotron text-center">
        <h2>Crud Application Using PHP</h2>
    </div>
    <br>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">타이틀:</label>
        <input type="text" name="title" class="form-control" placeholder="타이틀" value="<?php echo $title ?>">
    </div>
    <div class="form-group">
        <label for="name">컨텐츠:</label>
        <input type="text" name="content" class="form-control" placeholder="컨텐츠" value="<?php echo $content ?>">
    </div>

    <div class="form-group">
        <label for="name">Image:</label>
        <img src= "<?= "images/".$image?>" alt="" width="100px" height="100px" class="thumbnail">
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" value="업데이트" name="update">
    </div>
</form>

</div>    
</body>
</html>