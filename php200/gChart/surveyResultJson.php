<?php
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/connection/connection.php';

    $sql = "SELECT kind FROM survey";
    $result = $dbConnect->query($sql);

    if($result){
        $surveyDataCount = $result->num_rows;

        $offlineStore = 0;
        $onlineStore = 0;
        $website = 0;
        $friends = 0;
        $academy = 0;
        $noMemory = 0;
        $etc = 0;

        if($surveyDataCount > 0){
            for($i = 0; $i < $surveyDataCount; $i++){
                $surveyData = $result->fetch_array(MYSQLI_ASSOC);

                switch($surveyData['kind']){
                    case 'offlineStore':
                        $offlineStore++;
                        break;
                    case 'onlineStore':
                        $onlineStore++;
                        break;
                    case 'website':
                        $website++;
                        break;
                    case 'friends':
                        $friends++;
                        break;
                    case 'academy':
                        $academy++;
                        break;
                    case 'noMemory':
                        $noMemory++;
                        break;
                    case 'etc':
                        $etc++;
                        break;
                }
            }

            echo json_encode(
                array(
                    'result' => 'ok',
                    'offlineStore' => $offlineStore,
                    'onlineStore' => $onlineStore,
                    'website' => $website,
                    'friends' => $friends,
                    'academy' => $academy,
                    'noMemory' => $noMemory,
                    'etc' => $etc,
                )
            );
        } else {
            echo json_encode(
                array(
                    'result' => 'noData'
                )
            );
        }
    } else {
        echo json_encode(
            array(
                'result' => 'error'
            )
        );
    }
?>