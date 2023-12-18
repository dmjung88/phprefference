<?php
$idx = $_POST['idx'];
$userid = $_POST['userid'];
$pass = $_POST['pass'];

if($userid == "admin" && $pass == "1111"){ 

include('./db_conn.php');

$sql = "select * from kbread where id = $idx";
$result = mysqli_query($conn, $sql);
$re = mysqli_fetch_row($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
  
@font-face {
    font-family: 'KOTRA_BOLD-Bold';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_20-10-21@1.1/KOTRA_BOLD-Bold.woff') format('woff');
    font-weight: normal;
    font-style: normal;
    
    }
    @font-face {
    font-family: 'GmarketSansLight';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansLight.woff') format('woff');
    font-weight: normal;
    font-style: normal;
    }
    *{
            text-align: center;
            margin: 20px auto;
            font-family: 'GmarketSansLight';
        }
        table{
            text-align: center;

        }
      
        input:focus{

            background-color: rgb(255, 174, 145);
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
    <body>
    
        <h1 style="font-family: 'KOTRA_BOLD-Bold';color:BD8A61">수정</h1>
        <form method="POST" action="update.php">
            <table>
                <tr>  
                    <input type="hidden" name ="idx" value="<?php echo $idx ?>">
                  
                    <td>아이디 : <input type="text" name="uid" value="<?php echo $re[1]?>"></td>
                </tr>
                <tr>
                    <td>이름 : <input type="text" name="uname" value="<?php echo $re[2]?>"></td>
                </tr>
               
                <tr>
                    <td>전화번호 : <input type="text" name="uphone" value="<?php echo $re[3]?>"></td>
                </tr>
                <tr>
                    <td>비밀번호 : <input type="text" name="upass" value="<?php echo $re[4]?>"></td>
                </tr>
                <tr>
                <td><button type="submit" style="border: 0; color: white; background-color: #BD8A61; border-radius: 30px;" >입력완료</button></td>
                </tr>
                <tr>
                
            </tr>
            </table>
        </form>    

    </body>
</html>
<?php
}
else echo "<script>alert('아이디 혹은 비밀번호가 틀립니다')</script>";
?>