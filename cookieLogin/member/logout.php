<?php
# 로그아웃
    header('Content-Type: text/html; charset=utf-8');
 
    session_start();
    $result = session_destroy();
    if($result) {
?>
    <script>
        alert("로그아웃 되었습니다.");
        location.href="../board/list.php";
    </script>
<?php   }
?>
 