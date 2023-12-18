<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>제이쿼리</title>
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
   <!--제이쿼리-->
   <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>
 <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
</head>
<body>
    <header>
    </header>
    <!-- 계산 -->
책가격 : <input name="bookPrice" value="0">
할인 : <input id="discount_interface" maxlength="2" value="0">
<input name="bookDiscount" type="hidden" value="0">
<span class="">할인 가격 : <span class="span_discount"></span></span>

<p>셀렉트 카테고리 추가</p>
    <span>대분류 : </span>
    <select class="cate1">
        <option selected value="none">선택</option>
        <option value="TOP">탑</option>
        <option value="MID">미드</option>
        <option value="BOT">바텀</option>
    </select>
    <span>중분류 : </span>
    <select class="cate2">
        <option selected value="none">선택</option>
    </select>
    <span>소분류 : </span>
    <select class="cate3" name="cateCode">
    </select>
<script>
$(function() {
    	/* 할인율 Input 설정 */
    $("#discount_interface").on("propertychange change keyup paste input", function(){	
		let userInput = $("#discount_interface");
		let discountInput = $("input[name='bookDiscount']");
		
		let discountRate = userInput.val();					// 사용자가 입력한 할인값
		let sendDiscountRate = discountRate / 100;			// 서버에 전송할 할인값
		let goodsPrice = $("input[name='bookPrice']").val();			// 원가
		let discountPrice = goodsPrice * (1 - sendDiscountRate);		// 할인가격
		
		if(!isNaN(discountRate)){
			$(".span_discount").html(discountPrice);		
			discountInput.val(sendDiscountRate);				
		}		
	});	
	/* 할인값 처리 */
	$("input[name='bookPrice']").on("change", function(){
		
		let userInput = $("#discount_interface");
		let discountInput = $("input[name='bookDiscount']");
		
		let discountRate = userInput.val();					// 사용자가 입력한 할인값
		let sendDiscountRate = discountRate / 100;			// 서버에 전송할 할인값
		let goodsPrice = $("input[name='bookPrice']").val();			// 원가
		let discountPrice = goodsPrice * (1 - sendDiscountRate);		// 할인가격
		
		if(!isNaN(discountRate)){
			$(".span_discount").html(discountPrice);	
		}	
	});

    //셀렉트 카테고리 추가
    $('.cate1').change(function () {
        let top = ['가렌','말파이트','문도박사'];
        let bottom = ["이즈리얼",'케이틀린','코그모','트위치','자야','카이사'];
        let mid = ["르블랑","말자하","리산드라",'빅토르'];

        let selectChamp = $('.cate1').val();
        let changeChamp;
        if (selectChamp == "TOP") {
            changeChamp = top;
        } else if(selectChamp == "BOT") {
            changeChamp = bottom;
        } else if(selectChamp == "MID") {
            changeChamp = mid;
        }

        $('.cate2').empty();

        //for (let i = 0; i < changeChamp.length; i++) {
        for (let i in changeChamp) {
            $('.cate2').append("<option>" + changeChamp[i] + "</option>");
        }
    });

    $('.cate2').on("change",function (e) {
        e.preventDefault();

        let shoes = ["Sneakers", "Boots", "Loafers", "Derby Shoes", "Sandals","Slippers"];
        let bag = ["Backpack", "Cross bag", "clutches", "Tote bag", "Suitcase"];
        let accesories = ["Belt", "Socks", "Hat", "ETC"];

        let selectItem = $(this).find("option:selected").val();
        let changeItem;
        if (selectItem == "가렌") {
            changeItem = shoes;
        } else if(selectItem == "케이틀린") {
            changeItem = bag;
        } else if(selectItem == "리산드라") {  
            changeItem = accesories;
        }
        $('.cate3').children().remove();
        $('.cate3').append("<option value='none'>선택</option>");
        for(let i = 0; i < changeItem.length; i++) {
            var option2 = $("<option>" + changeItem[i] + "</option>");
            $('.cate3').append(option2);
        }
    });

}) //docs
</script>

</body>
</html>