<?php
    include 'db.php';

    $sql="SELECT uid FROM BOARD";
    $get = mysqli_query($db,$sql);

    //if(isset($_POST['saves'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $title= mysqli_real_escape_string($db,$_POST['title']);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); //유효성 실패시 공백
        $writer = filter_input(INPUT_POST, 'writer', FILTER_SANITIZE_STRING);

        $query="INSERT INTO BOARD(title,content, email,writer) VALUES ('$title','$content', '$email','$writer')";
        $query= mysqli_real_query($db, $query);
        if(!$query){
            echo "<script>
                alert('Error!.');
            </script>";
        }else{
        // echo "<script>
        //     alert('Message');
        // </script>";
            echo "
            <script>
                alert('Details are Sent');
                window.location.href='index.php';
            </script>
            ";
        }
    }
       

?>
<!DOCTYPE html>
<html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
    <link rel="stylesheet" href="style.css">
<script src="script.js"></script> 
<!-- <script src="validate.js"></script> -->
 </head>
 <body>
     <link rel="stylesheet" href="pure-release-1.0.0/pure-release-1.0.0/buttons.css">
     <form name="ian" class="pure-form" method="post" action="#" autocomplete="off">
    <fieldset>
        <legend>인서트</legend>

        <input type="text" name="title" placeholder="타이틀"><br><br>
        <input type="text" name="email" placeholder="이메일"><br><br>
        <input type="text" name="content" placeholder="컨텐츠" ><br><br>
        <input type="text" name="writer" placeholder="작가"><br><br>

        <button type="button" onclick="validateForm()" class="pure-button pure-button-primary">등록</button><hr>
    </fieldset>
</form>

<form>
    <select name="users" onchange="showUser(this.value)"> 
    <option value="0">Please Select</option>
        <?php  while($row = mysqli_fetch_assoc($get)) : ?>
            <option value = "<?php echo($row['uid'])?>" >
                <?php echo $row['uid'] ?>
            </option>
        <?php  endwhile       ?>
    </select>
<form>
<div id="txtHint"><b>리스트</b></div>
      
<script>
    function validateForm() {
        var x = document.forms["ian"]["title"].value;
        var y = document.forms["ian"]["email"].value;
        var z = document.forms["ian"]["content"].value;
        if (x == "")  {
            alert("Please Fill out 타이틀 Field");
            return false;
        } else if (y == "")  {
            alert("Please Fill out email Field");
            return false;
        } else if (z == "")  {
            alert("Please Fill out content Field");
            return false;
        } else {
            //document.ian.submit();
            document.forms["ian"].submit();
        }
    }
    function showUser(str) {
        if (str=="") {
            document.getElementById("txtHint").innerHTML="";
            return;
        }
    }
</script>
 </body>
 </html>