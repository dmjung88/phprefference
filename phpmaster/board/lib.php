<?php

    error_reporting(1);
    ini_set("display_errors", 1);


    $connect = mysqli_connect("localhost","root","","korea"); 
    //( host, username, password, databasename, port, socket )
    
    if(mysqli_connect_error()){
        echo "mysql 접속중 오류가 발생했습니다. ";
        echo mysqli_connect_error(); 
    }
?>