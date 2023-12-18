<?php 

	$connection = mysqli_connect("localhost","root","","ajax");
	if (isset($_POST)){

		$car_id = $_POST["car_id"];
		$query = "DELETE FROM cars WHERE id = '$car_id'";
		 
		$query_result = mysqli_query($connection,$query);

		if (!$query_result){
			die("Query Failed ".mysqli_error($connection));
		}

	}
	

?>