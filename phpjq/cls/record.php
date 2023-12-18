<?php

include_once('inc/class.php');
$user_function = new Userfunction();

if(isset($_POST['keyword']) && !empty(trim($_POST['keyword']))){
    $keyword = $user_function->htmlvalidation($_POST['keyword']);
    $match_field['surname'] = $keyword;
	$match_field['forename'] = $keyword;
	$select = $user_function->search($match_field, "OR");
}else {
    $select = $user_function->select("member2");
}
?>

<table class="table" style="vertical-align: middle; text-align: center;">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">성</th>
        <th scope="col">명</th>
        <th scope="col">이멜</th>
        <th scope="col">사용중</th>
        <th scope="col">역할</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if($select){ 
        foreach($select as $key => $row): ?>
    <tr>
        <th scope="row"><?= $key + 1; ?></th>
        <td><?php echo $row['forename']; ?></td>
        <td><?php echo $row['surname']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['is_active']; ?></td>
        <td><?php echo $row['role_id']; ?></td>
        <td>
            <button type="button" class="btn btn-danger editdata" data-dataid="<?= $row['id']; ?>" data-toggle="modal" data-target="#updateModalCenter">Update</button>
            <button type="button" class="btn btn-danger deletedata" data-dataid="<?= $row['id']; ?>" data-toggle="modal" data-target="#deleteModalCenter">Delete</button>
        </td>
    </tr>
    <?php endforeach;
        }else{ echo "<tr><td colspan='7'><h2>No Result Found</h2></td></tr>"; } ?>
    </tbody>
</table>	