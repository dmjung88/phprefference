<?php
$idx=$_GET['idx'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
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
        
        <h1 style="font-family: 'KOTRA_BOLD-Bold';">관리자 확인</h1>      
        
        <div class="container text-center">
        <form action="updateform.php" method="POST">
        <table>
                <tr>
                <td>아이디 : <input type="text" name="userid" value="admin"></td>
            </tr>

            <tr>
                
            <td>비밀번호 : <input type="password" name="pass" value="1111"></td>
            <input type="hidden" name="idx" value="'<?php echo $idx ?>'" > 
            </tr>
           
        </table>
        <button type="submit" style="border: 0; color: white; background-color: #BD8A61; border-radius: 30px;" >입력완료</button>
    </form>
    </div>
</body>
</html>



