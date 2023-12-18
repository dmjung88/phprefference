<?php 
	
	$connection = mysqli_connect("localhost","root","","ajax");

	if (isset($_POST)){
		$title = $_POST["car_title"];
		if (!empty($title)){
			$query = "INSERT INTO cars (title) values( '$title')";

			$add_query = mysqli_query($connection,$query);

			if (!$add_query){
				die("Query Failed ".mysqli_error($connection));
			}
			echo "<p class='lead alert alert-danger'>".$title. " is added to database</p>";
		}
	}


	
?>