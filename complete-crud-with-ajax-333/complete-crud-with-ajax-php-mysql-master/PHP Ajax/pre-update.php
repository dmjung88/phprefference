<?php 
	
	$connection = mysqli_connect("localhost","root","","ajax");

	if (isset($_POST)){
		$id = $_POST["id"];
		$query = "SELECT * FROM cars WHERE id = '$id'";
		$search_car_result = mysqli_query($connection,$query);

		while ($row = mysqli_fetch_array($search_car_result)) {
			echo $row['title'];
		}
	}

    