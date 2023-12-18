<?php  

	$connection = mysqli_connect("localhost","root","","ajax");
	if (isset($_POST)){

		$id = $_POST["id"];
		$title = $_POST["title"];

		$query = "UPDATE cars SET title='$title' WHERE id = '$id'";

		$query_result = mysqli_query($connection,$query);

		if (!$query_result){
			die("Query Failed ".mysqli_error($connection));
		}
		echo "Car is successfully update";

	}

?>