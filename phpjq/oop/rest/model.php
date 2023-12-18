<?php
require_once "../controller/DB.php";
require_once "../controller/Product.php";

$mode = $_REQUEST['mode'];

$objProduct = new Product();
$result = "";
$categories = ["top","bottom","outer","shoes", "bag",'accesories'];

$mode = $_REQUEST['mode'];

if($mode === 'load') { // 목록보기
    $i=1;
	$users = $objProduct->getAll();
    while($row = $users->fetch_assoc()){
        $img = $row["picture"] ?  $row["picture"] : 'nope.jpg';
        $result.="<tr>";
		$result.="<td>".$i++."</td>";
		$result.="<td>".$row["forename"]."</td>";
		$result.="<td>".$row["usr_name"]."</td>";
		$result.="<td>".$row["surname"]."</td>";
		$result.="<td><img src='images/".$img."'></td>";
		$result.="<td><a class='edit' href='#' data-id='".$row["id"]."'>Edit</a> | <a class='delete' href='#' data-id='".$row["id"]."'>Delete</a></td>";
	    $result.="</tr>";
    }
    echo $result;
} else if($mode === 'insert') { //입력
	$forename = $_REQUEST['productName'];
	$surname = $_POST['productDescription'];

	$sourcePath = $_FILES['productImg']['tmp_name'];
	$fileOriginalName = $_FILES['productImg']['name'];
	// 13자리 유니크 ID를 생성 , 타임스탬프를 정수형태
	$fileName = uniqid() . time() .$fileOriginalName;

	if(empty($sourcePath)){
		$fileName = "nope.jpg";
	}else{
		$targetPath = "../images/".$fileName;
		move_uploaded_file($sourcePath,$targetPath) ;
	}
	$objProduct->save($forename, $surname, $fileName);
	echo '입력성공';
} else if($mode ==='loadOne') {
	$id = $_GET['id'];
	$result = $objProduct->show($id)->fetch_assoc();
	echo json_encode($result);
} else if ($mode =='category') {
	$product = $objProduct->show($_REQUEST['id'])->fetch_assoc();
	$result.="<option value='-1'>";
	$result.="Select One";
	$result.="</option>";
	foreach($categories AS $categorie) {
		$result.="<option value='".$categorie."'";
		if($categorie == $product['id'])  $result.= " selected";
		$result.=">";
		$result.=$categorie;
		$result.="</option>";
	}
	echo $result;
} else if($mode =='allCategory') {
	$result.="<option value='-1'>";
	$result.="Select One";
	$result.="</option>";
	foreach($categories AS $categorie) {
		$result.="<option value='".$categorie."'>";
		$result.=$categorie."</option>";
	}
	echo $result;
} else if($mode === 'update') {
	$forename = $_REQUEST['productName'];
	$surname = $_REQUEST['productDescription'];
	$id = $_REQUEST['id'];

	$sourcePath = $_FILES['productImg']['tmp_name'];
	$fileOriginalName = $_FILES['productImg']['name'];
	// 13자리 유니크 ID를 생성 , 타임스탬프를 정수형태
	$fileName = uniqid() . time() .$fileOriginalName;
	if(empty($sourcePath)){
		$fileName = "default.jpg";
	}else{
		//unlink("../images/이전파일명");
		$targetPath = "../images/".$fileName;
		move_uploaded_file($sourcePath,$targetPath) ;
	}
	$objProduct->update($id, $forename, $surname, $fileName);
	echo '수정성공';
} else if($mode == "delete" ){
	$id = $_REQUEST['id'];
	$objProduct->delete($id);
	echo '삭제성공';
}


?>
