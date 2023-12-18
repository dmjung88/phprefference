<?php
include "db_conn.php";

// function to fetch data
    if ($_GET["action"] === "fetchData") {
        $sql = "SELECT * FROM member2 order by id desc";
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        mysqli_close($conn);
        header('Content-Type: application/json');
        echo json_encode([ "data" => $data ]);
    }
    if ($_GET["action"] === "insertData") {
        if (!empty($_POST["first_name"]) && isset($_POST["last_name"]) && !empty($_POST["email"]) && !empty($_POST["country"]) && !empty($_POST["gender"]) && $_FILES["image"]["size"] != 0) {
            $forename = mysqli_real_escape_string($conn, $_POST["first_name"]);
            $surname = mysqli_real_escape_string($conn, $_POST["last_name"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);

            $original_name = $_FILES["image"]["name"];
            $new_name = uniqid() . time() . "." . pathinfo($original_name, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/phpjq/imgm/images/" . $new_name);
            $sql = "INSERT INTO `member2`(`forename`, `surname`, `email`, `picture`) VALUES ('$forename','$surname','$email','$new_name')";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["statusCode" => 200,"message" => "입력 성공 😀"]);
            } else {
                echo json_encode(["statusCode" => 500,"message" => "입력 실패 😓"]);
            }
        } else  //유효성 실패
        echo json_encode(["statusCode" => 400,"message" => "유효성 실패 🙏"]);      
    } 

    if($_GET['action'] == 'fetchAll') {
        $sql = "SELECT * FROM member2 order by id desc";
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        mysqli_close($conn);
        header('Content-Type: application/json');
        echo json_encode([ "data" => $data ]);
    }
    if ($_GET["action"] === "fetchSingle") {
        $id = intval($_POST["id"]);
        $sql = "SELECT * FROM member2 WHERE `id`=$id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            header("Content-Type: application/json");
            echo json_encode(["statusCode" => 200,"data" => $data]);
        } else 
            echo json_encode(["statusCode" => 404,"message" => "No user found with this id 😓"]);
    }

    if ($_GET["action"] === "deleteData") {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $delete_image = $_POST["delete_image"];

        $sql = "DELETE FROM member2 WHERE `id`=$id";
        if (mysqli_query($conn, $sql))  {
            unlink($_SERVER['DOCUMENT_ROOT']."/phpjq/imgm/images/" . $delete_image);
            echo json_encode([ "statusCode" => 200,"message" => "사진+데이터 삭제성공 😀"]);      
        } else { 
            echo json_encode(["statusCode" => 500,"message" => "Failed to delete data 😓"]);
        }
    }
