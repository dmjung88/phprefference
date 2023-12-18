<?php 
	$connection = mysqli_connect("localhost","root","","ajax");

	$search = $_POST["search"];

	if (!empty($search)){
		$query = "SELECT * FROM cars WHERE title LIKE '$search%'";

		$search_query = mysqli_query($connection,$query);

		if (!$search_query){
			die("Query Failed ".mysqli_error($connection));
		}else{
			while ($row = mysqli_fetch_array($search_query)) {
				echo "<h1 class='alert alert-primary'>".$row['title'] . " is in the stock. <button class='btn btn-danger' id='btn-delete' data-id='".$row['id']."'>Delete </button> <button class='btn btn-success' id='btn-update' data-id='".$row['id']."' >Update </button></h1>";
			}
		}
	}
?>