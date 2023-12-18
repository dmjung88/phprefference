<?php  

    include_once "./connection.php";

	if (isset($_POST)){

		$id = esc($_POST["id"]);
		$forename = clean($_POST["title"]);

		$query = "UPDATE MEMBER2 SET forename='$forename' WHERE id = '$id'";
		$result = mysqli_query(connection(),$query);

		if (!$result){
			die("Query Failed ".mysqli_error(connection()));
		}
		echo "Car is successfully update";

	}

?>