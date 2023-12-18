<link rel="stylesheet" href="css/list.css">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.k-bread.com/favicon.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html"><img src="https://www.k-bread.com/_skin/sw_kor_1/img/common/logo_on.png" alt="" width="170px"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
    
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              BRAND
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">브랜드 스토리</a></li>
              <li><a class="dropdown-item" href="#">명장 김영모</a></li>
              <li><a class="dropdown-item" href="#">PR/MEDIA</a></li>
            
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              PRODUCT
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">신제품</a></li>
              <li><a class="dropdown-item" href="#">구움과자</a></li>
              <li><a class="dropdown-item" href="#">선물세트</a></li>
              <li><a class="dropdown-item" href="#">빵</a></li>
              <li><a class="dropdown-item" href="#">케이크</a></li>
              <li><a class="dropdown-item" href="#">초콜릿</a></li>
              <li><a class="dropdown-item" href="#">브런치</a></li>
              <li><a class="dropdown-item" href="#">빙과류</a></li>
              <li><a class="dropdown-item" href="#">주문케이크</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              STORE
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">김영모 과자점</a></li>
              <li><a class="dropdown-item" href="#">PÉRE et FILS</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              COMMUNITY
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">공지사항</a></li>
              <li><a class="dropdown-item" href="#">이벤트</a></li>
              <li><a class="dropdown-item" href="#">SNS</a></li>
              <li><a class="dropdown-item" href="#">FAQ</a></li>
              <li><a class="dropdown-item" href="#">1:1문의</a></li>
           
          </li> </ul>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              E-SHOP
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="#">선물세트</a></li>
              <li><a class="dropdown-item" href="#">단품선물세트</a></li>
              <li><a class="dropdown-item" href="#">바움쿠헨 & 마카롱</a></li>
              <li><a class="dropdown-item" href="#">롤케이크 & 카스테라</a></li>
              <li><a class="dropdown-item" href="#">쿠폰상품</a></li>
              <li><a class="dropdown-item" href="#">맞춤제작</a></li>
            </ul>
          </li>
        
        </ul>
        <ul class="navbar-nav">
          <a href="login.html" id="Login"><img src="img/enter.png" alt="" width="20px" style="margin-right: 10px;">Login</a>
          <a href="join.html" id="Login"><img src="img/login.png" alt="" width="20px" style="margin-right: 10px;">Join</a>
          <a href="list.php" id="Login"><img src="img/list.png" alt="" width="20px" style="margin-right: 10px;">List</a>
          <a href="#" id="Login"><img src="img/shopping-cart.png" alt="" width="20px" style="margin-right: 10px;">Cart</a>
         </ul> 

      </div>
    </div>
  </nav>
  <h1 class="title-list text-center">회원 목록</h1>
<style>
  
</style>
<?php

$url = 'localhost';
$id = 'test'; 
$pass = '1111';
$db = 'testdb';
$conn = mysqli_connect($url,$id,$pass,$db);


//if($conn) echo "연결 성공!";
//else echo "연결 실패";
$sql = "select * from kbread"; //똑같이 2차원배열로 reslut로 들감
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
// 한줄씩 갖고오기 리턴값이 있으므로 변수에 저장


for($i = 0; $i<$count ; $i++){
  $re = mysqli_fetch_row($result);
?>
<table class="table text-center">
  <thead>
<tr>
 <th class="title">#</th>
 <th class="title">아이디</th>
 <th class="title">이름</th>
 <th class="title">전화번호</th>
 <th class="title">비밀번호</th>
 <th class="title">비고</tr>  
<tr>
  <td><?php echo"$re[0]" ?></td>
  <td><?php echo "$re[1]" ?></td>
  <td><?php echo "$re[2]" ?></td>
  <td><?php echo "$re[3]" ?></td>
  <td><?php echo $re[4]?></td>
  
  <td><a class ="update" href='updatepass.php?idx=<?php echo "$re[0]"?>'>수정</a>
      <a class ="delete" href='deleteform.php?idx=<?php echo "$re[0]"?>'>삭제</a></td>
</tr>     
</thead>
<?php
}
?>          
</table>
<div class="container">
            <div class="row">
        <button type="submit" class="sub-btn"  onclick = "location.href = 'join.html'">회원가입</button>
            </div>
        </div>

        <div style="background-color: #2F2B29; margin-top: 100px;  text-align: center;">
    <img src="https://www.k-bread.com/_skin/sw_kor_1/img/common/footer_logo.gif" alt="">
  <ul>
    <li class="footer-li"><a href="#" style="color: white; text-decoration: none;">이용약관</a></li> |
    <li class="footer-li"><a href="#" style="color: white; text-decoration: none;">개인정보처리방침</a></li> |
      <li class="footer-li"><a href="#" style="color: white; text-decoration: none;">인재채용</a></li> |
        <li class="footer-li"><a href="#" style="color: white; text-decoration: none;">협력 및 제안문의</a></li>
  </ul>
  <address style="color: white; font-family: 'GmarketSansLight';" >
    ㈜파치시에 김영모
    <span></span>
    대표 : 서민정
    <span></span>
    사업자번호 : 129-86-21289
    <span></span>
    통신판매업신고번호 : 제2009-경기성남-0368호
    <span></span>
    이메일 : kymbread@naver.com<br>
    경기 성남시 중원 사기막골로 159(상대원동 138-1) 금강하이테크밸리2차 108호
    <span></span>
    Tel: 031)737-4064
    <span></span>
    Fax: 031)737-4266
    <span></span>
    상담시간: 평일 9시~18시
    <span></span>
    <br>
    개인정보관리책임자: 김정희031-737-4064
    <span></span>
    *김영모과자점의 홈페이지는 ㈜파치시에 김영모에서 운영합니다.
    <br><br>
    <p>Copyright © 김영모과자점,  All Rights Reserved</p>
    
  </address>
  </div> 