<?php
    $action = $_REQUEST['action'];

    if (!empty($action)) {
        require_once '../inc/Player.php';
        $obj = new Player();
    }
    //get?action=getusers
    if ($action == "getusers") { 
        $page = (!empty($_GET['page'])) ? intval($_GET['page']) : 1;
        $limit = 4;
        $start = ($page - 1) * $limit;

        $players = $obj->getRows($start, $limit);
        if (!empty($players)) 
            $playerslist = $players;
        else
            $playerslist = [];
        $total = $obj->getCount();
        $playerArr = ['count' => $total, 'players' => $playerslist]; 
        echo json_encode($playerArr);
        exit();
    }
    //POST hidden name="action" value="adduser" 입력 OR 수정
    if ($action == 'adduser' && isset($_POST)) {
        $forename = $_POST['username'];
        $surname = $_POST['phone'];
        $email = $_POST['email'];
        $picture = $_FILES['photo'];
        $pk = (!empty($_POST['userid'])) ? $_POST['userid'] : '';
        $imagename = '';
        if (isset($picture['name'])) {
            $imagename = $obj->uploadPhoto($picture);
            $data = [
                'forename' => $forename,
                'surname' => $surname,
                'email' => $email,
                'picture' => $imagename,
            ];
        } else { //noImage
            $data = [
                'forename' => $forename,
                'surname' => $surname,
                'email' => $email,
            ];
        }
        if ($pk) {
            $obj->update($data, $pk);
        } else {
            $pk = $obj->add($data);
        }
        if (!empty($pk)) {
            $member = $obj->getRow('id', $pk);
            echo json_encode($member);
            exit();
        }
    } // 입력 + 수정 끝
    // 상세보기
    if ($action == "getuser") {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $member = $obj->getRow('id', $id);
        echo json_encode($member);
        exit();
    }
    //삭제
    if($action == 'deleteuser') {
        $playerId = (!empty($_GET['id'])) ? intval($_GET['id']) : '';
        $isDeleted = $obj->deleteRow($playerId);
        if($isDeleted) {
            $message = ['deleted' => 1];
        }else {
            $message = ['deleted' => 0];
        }
        echo json_encode($message);
    }
    //검색
    if($action == 'search') {
        $queryString = (!empty($_GET['searchText'])) ? trim($_GET['searchText']) : '';
        $results = $obj->searchPlayer($queryString);
        echo json_encode($results);
        exit();
    }

?> 