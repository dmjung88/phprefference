<?php
    include "db.php"; 
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//code.jquery.com/jquery-latest.min.js"></script> 

    <script>
         function getGugun(a){
           $.get("getGugun.php?sido="+a,function(data){
                $("#areaGugun").html(data); 
                $("#areaDong").html(""); 
                $("#addr").val("");  

           }); 
         }

         function getDong(a){
           $.get("getDong.php?gugun="+a,function(data){
                $("#areaDong").html(data); 
                $("#addr").val("");  
           }); 

         }
    </script>
</head>
<body>

    <table border=1 width=600>
        <tr>
            <td> 시도 </td>
            <td> 구군 </td>
            <td> 동 </td>
            <td> 상세주소입력</td>
        </tr>
        <tr>
            <td>    
            <select name="sido" id="sido" onchange="getGugun(this.value);" >
                <option value="">시도를 선택하세요. </option> 
                <?php
                    $db -> groupBy("sido");
                    $list = $db->get("dong"); 

                    foreach($list as $data){
                    ?>
                    <option value="<?=$data['sido']?>"><?=$data['sido']?></option> 
                <?php } ?>  
            </select> 

            </td>
            <form action="dong_pro.php" method="post">
            <td><div name="areaGugun" id="areaGugun"></div></td>
            <td><div name="areaDong" id="areaDong"></div></td>
            <td><input type="text" name="addr" id="addr"></td>
            
        <select name='areaGugun1'>
            <option value='' selected>-- 선택 --</option>
            <option value='남'>남구</option>
            <option value='중'>중구</option>
            <option value='동'>동구</option>
            <option value='서'>서구</option>
            <option value='북'>북구</option>
        </select>  

        <select name='areaDong1'>
            <option value='' selected>-- 선택 --</option>
            <option value='A'>A동</option>
            <option value='B'>B동</option>
            <option value='C'>C동</option>
        </select>  

            <p><input type="submit" value="주소입력완료 버튼"></p>

            </form>                  

        </tr>

    </table>
    
</body>
</html>