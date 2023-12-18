<?php
    include "db.php";
 
    
    $areaGugun = $_POST['areaGugun1'];
    $areaDong = $_POST['areaDong1'];
    $addr = $_POST['addr'];
   
    echo $areaGugun.'구  '.$areaDong.'동  '.$addr;
?>

   