<?php 
	
    include_once "./connection.php";

	if (isset($_POST)){
		$id = esc($_POST["id"]);
		$query = "SELECT * FROM MEMBER2 WHERE id = '$id'";
		$result = mysqli_query(connection(),$query);

		while ($row = mysqli_fetch_array($result)) {
			echo $row['forename'];
		}
	}

?>