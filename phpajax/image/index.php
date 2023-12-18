<?php

include 'inc/db.php';

$sql = "SELECT * FROM `board` ORDER BY uid DESC ";
$result = mysqli_query($db, $sql);

if(isset($_GET['delete'])) {
    $id = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);
    $sql = "SELECT * FROM board WHERE uid = '$id'";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_array($result)) {
        $img= $row['image'];
        unlink("images/".$img);
    }
    $query = "DELETE FROM `board` WHERE UID = {$id}";
    $result = mysqli_query($db,$query);
    if($result){
        header('location:index.php');   
    } else {
        echo mysqli_errno($db).mysqli_error($db) ;
    }
} //endFunction

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>이미지 인서트</title>
</head>
<body>
<div class="container">
    <div class="jumbotron text-center">
        <h2>Crud Application Using PHP</h2>
    </div>
    <br>
    
    <a href="insert.php" role="button" class="btn btn-primary pull-right">인서트 모달</a>
    <br>
    <table class="table table-hover table-striped">
        <tr>
            <th>ID</th>
            <th>타이틀</th>
            <th>컨텐츠</th>
            <th>이미지</th>
            <th>Action</th>
        </tr> 
    <?php while($board = mysqli_fetch_array($result)) :?>
        <tr>
            <td><?=$board['uid']; ?></td>
            <td><?=$board['title']; ?></td>
            <td><?=$board['content']; ?></td>
            <td>
                <img src= "<?= "images/".$board['image']?>" alt="섬네일" class="thumbnail" width="100px" height="75px">
            </td>
            <td>
                <a href="update.php?update=<?php echo $board['uid'] ?>" class="btn btn-success btn-sm" role="button">Update</a>
                <a href="index.php?delete=<?php echo $board['uid'] ?>" class="btn btn-danger btn-sm" id="delete" role="button">Delete</a>
            </td>
        <tr>
    <?php endwhile ?>
</body>
<script>
$(document).ready(function(){
    $('#delete').click(function(){
        if(!confirm("삭제?")) {
            return false;
        }
    });
});//doc
</script>
</html>