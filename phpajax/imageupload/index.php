<?php
    include('./inc/db.php');
    $upload_dir = 'uploads/';

    if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$sql = "select * from BOARD where UID = ".$id;
		$result = mysqli_query($db, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$image = $row['image'];
			unlink($upload_dir.$image);
			$sql = "delete from BOARD where UID=".$id;
			if(mysqli_query($db, $sql)){
				header('Location:index.php');
			}
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </head>
  <body>

      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="index.php">PHP CRUD WITH IMAGE</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto"></ul>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="btn btn-primary" href="create.php"><i class="fa fa-user-plus"></i></a></li>
              </ul>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                <?php if(isset($successMsg)) : ?>
                    <div class="card-header"><?=$successMsg?></div>
                <?php endif?>
                      <div class="card-body">
                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Contact No:</th>
                                <th>E-Mail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>타이틀</th>
                            <th>컨텐츠</th>
                            <th>Actions</th>
                          </tr>
                        </tfoot>
<tbody>
    <?php
        $sql = "select * from BOARD ORDER BY UID DESC";
        $result = mysqli_query($db, $sql);
                if(mysqli_num_rows($result) > 0 ):
                    while($row = mysqli_fetch_assoc($result)):
    ?>
    <tr>
        <td><?php echo $row['uid'] ?></td>
        <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
        <td><?php echo $row['title'] ?></td>
        <td><?php echo $row['content'] ?></td>
        <td class="text-center">
            <a href="show.php?id=<?= $row['uid'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
            <a href="edit.php?id=<?= $row['uid'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
            <a href="index.php?delete=<?= $row['uid'] ?>" class="btn btn-danger" onclick="return confirm('삭제?')"><i class="fa fa-trash-alt"></i></a>
        </td>
    </tr>
    <?php
            endwhile;
        endif;
    ?>
</tbody>

</table>
</div>
</div>
</div>
</div>
</div>

<script src="js/bootstrap.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
</body>
</html>
