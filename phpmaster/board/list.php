<?php
    include("lib.php");

?>



<table width=800 border="1" >
    <tr>
        <th width=50 > No  </th> 
        <th> 제목   </th> 
        <th width=100> 작성자  </th> 
        <th width=90 > 작성일자   </th> 
    </tr>    
<?php

    $query = "select * from sing_board order by idx desc ";
    $result = mysqli_query($connect, $query); 
    //print_r($result);
   
    while($data = mysqli_fetch_array($result)){
    
    //var_dump($data);
?>
    <tr>
        <td> <?=$data['idx']?> </td>
        <td> <a href="view.php?idx=<?=$data['idx']?>"><?=$data['subject']?></a> </td>
        <td> <?=$data['name']?> </td>
        <td> <?=substr($data['regdate'],0,10)?> </td>

<?php } ?>

</table>


<a href="write.php">글쓰기</a> 



