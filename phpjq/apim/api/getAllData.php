<?php

require '../config/db_config.php';

$num_rec_per_page = 5;

    if (isset($_GET["page"])) { 
        $page  = intval($_GET["page"]); 
    } else { 
        $page=1; 
    };

$start_from = ($page-1) * $num_rec_per_page;
$sqlTotal = "SELECT * FROM `member2`";
$sql = "SELECT * FROM member2 Order By id desc LIMIT $start_from, $num_rec_per_page"; 
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $json[] = $row;
}
$data['data'] = $json;
$resultTotal =  mysqli_query($conn,$sqlTotal);
$data['total'] = mysqli_num_rows($resultTotal);
echo json_encode($data);
?>