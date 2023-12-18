<?php

include_once "../functions/db.php";
$db = connection();
$query = "SELECT * FROM `member2`";
$result = mysqli_query($db, $query);
$output = '';
if(mysqli_num_rows($result)){
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<tr>';
        $output .= '<td>'.$row['id'].'</td>';
        $output .= '<td>' . $row['forename'] . ' '. $row['surname'].'</td>';
        $output .= '<td>' . $row['is_active'] . '</td>';
        $output .= '<td>' . $row['role_id'] . '</td>';
        $output .= '<td>' . $row['joined'] . '</td>';
        $output .= '<td>' . "교육" . '</td>';
        $output .= '<td>' . "주소" . '</td>';
        $output .= "<td><a data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editModal' href='' id='update' class='edit'>
        <i class='fa fa-edit'></i></a>  <a data-id='" . $row['id'] . "' class='delete' id='delete' href='' data-toggle='modal' data-target='#deleteModal'><i class='fa fa-trash'></i></a> <a data-id='" . $row['id'] . "' class='view' id='view' href='' data-toggle='modal' data-target='#viewModal'><i class='fa fa-eye'></i></a></td>";
        $output .= '</tr>';
    }
    echo json_encode(['status'=>'success', 'table' => $output]);
} else {
    $table .= '<tr colspan="8"';
    $table .= '<td>NO DATA!</td>';
    echo json_encode(['status' => 'success', 'table' => $table]);
}
