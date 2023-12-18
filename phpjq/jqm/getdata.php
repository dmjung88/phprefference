<table class="table table-hover table-responsive">
<thead>
    <tr>
        <th>넘버<?php  $sno=1;?></th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th colspan="2">Action</th>
    </tr>
</thead>
<tbody>

<?php
include('inc/db.php');
    $list = "SELECT * FROM member2";
    $rs = mysqli_query($db,$list);
    if(mysqli_num_rows($rs) > 0):
        while($row = mysqli_fetch_assoc($rs)):  ?>
	 	<tr>
            <td><?php echo $sno++; ?></td>   
            <td><?= $row['forename']; ?></td>
            <td><?= $row['surname']; ?></td>
            <td><?php echo $row['email']; ?></td>  
            <td><?= "<a href='edit.php?id=$row[id]'><button class='btn btn-warning'>편집</button></a>"?></td>    
            <td><a href="#" id = "<?= $row['id'] ?>" class="trash" >Del</td>
        </tr>
    <?php endwhile;
    endif;  ?>
</tbody>
</table>
<?php include_once('inc/footer.php'); ?>
<script>
$(document).ready(function(){
    $(".trash").on('click',function() {
        var $ele = $(this).parent().parent();
        if(confirm("진짜 삭제?")) {
            $.ajax({
                type:'POST',
                url:'delete.php',
                data:{id: $(this).attr('id')},
                success: function(data){
                    console.log(data);
                    if(data == "YES"){
                        console.log('엘리먼트 : ' ,$ele);
                        $ele.fadeOut().remove();
                    }else{
                        alert("can't delete the row")
                    }
                }
            });
        }
    })
}) //document
</script>