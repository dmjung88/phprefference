<?php
    /* 이프로 그램은 실제서버에 코드를 입력하는 기능을 갖고있다나쁜목적으로 사용하면 치명적 결과 초래*/

    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/session.php';
    include $_SERVER['DOCUMENT_ROOT'].'/php200/common/checkSignSession.php';

    $code = $_POST['code'];

    //파일명 만들기
    function makeFileName(){
        $existsFileList = array();
        $opendir = opendir('./codeList');

        while(($readdir = readdir($opendir))){
            array_push($existsFileList, $readdir);
        }

        $isEqualNameCheck = false;

        while(true){
            $fileName = 'php200-'.mt_rand().'.php';

            foreach($existsFileList as $efl){
                if($efl == $fileName){
                    $isEqualNameCheck = true;
                }
            }

            if($isEqualNameCheck == false){
                return $fileName;
            }
        }
    }

    $fileName = makeFileName();
    $filePath = $_SERVER['DOCUMENT_ROOT'].'/php200/webEditor/codeList/';
    $myfile = fopen($filePath.$fileName, "w") or die("파일 열기 실패");
    fwrite($myfile, $code);
    fclose($myfile);
    header("Location:./codeList/".$fileName);
?>