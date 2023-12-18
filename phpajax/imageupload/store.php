<?php
  require_once('./inc/db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $content = mysqli_real_escape_string($db, $_POST['content']);

    $imgName = $_FILES['image']['name']; //original_name
    $imgTmp = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

    if(empty($title)){
        $errorMsg = 'NO 제목';
    }elseif(empty($content)){
        $errorMsg = '냉무';
    } else {
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

        $allowExt  = array('jpeg', 'jpg', 'png', 'gif');

        $userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

        if(in_array($imgExt, $allowExt)){

            if($imgSize < 5000000){
                move_uploaded_file($imgTmp ,$upload_dir.$userPic);
            }else{
                $errorMsg = '이미지 사이즈 초과';
                print '이미지 사이즈 X';
            }
        }else{
            $errorMsg = '이미지 확장자 X';
            print '이미지 확장자 X';
        }
    }

    if(!isset($errorMsg)){
        $sql = "insert into BOARD(title, content, image)
                values('".$title."', '".$content."', '".$userPic."')";
        $result = mysqli_query($db, $sql);
        if($result){
            $successMsg = '이미지업로드 성공';
            header('Location: index.php');
        }else{
            $errorMsg = 'Error '.mysqli_error($conn);
        }
    }
  }
?>
