<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
?>
<!doctype html>
<html>
<head>
</head>
<body>
<form name="boardWrite" method="post" action="saveBoard.php">
    제목
    <br>
    <br>
    <input type="text" name="title" required/>
    <br>
    <br>
    내용
    <br>
    <br>
    <textarea name="content" cols="80" rows="10" required></textarea>
    <br>
    <br>
    <input type="submit" value="저장" />
</form>
</body>
</html>