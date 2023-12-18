<?php 
    include_once "./connection.php";

    if (isset($_POST)){
		$forename = clean($_POST["car_title"]);
        $surname = '자동차';
		if (!empty($forename)){
			$query = "INSERT INTO MEMBER2 (forename,surname) values( '$forename','$surname')";

			$result = mysqli_query(connection(),$query);

			if (!$result){
				die("Query Failed ".mysqli_error(connection()));
			}
			echo "<p class='lead alert alert-danger'>".$forename. " 디비 추가 완료</p>";
		}
	}

?>