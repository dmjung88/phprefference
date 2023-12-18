const loadData = () => {
    $.get({
        url : "rest/model.php",
        data : {mode:'load'},
        success : function(data){
            //console.log(data)
            $("body table tbody").html(data); 컨트롤러에서 html 만들어서 브라우저로 바로던지는 방식
        }
    })
    $.get({
        url : "rest/model.php",
        data : {mode:"allCategory"},
        success : function(data){
            $("select[name= category]").html(data); 컨트롤러에서 html 만들어서 브라우저로 바로던지는 방식
        }
    })
}
const getData = (id) => {
    $.get({
        url : "rest/model.php",
        data : {mode:'loadOne', id},
        success : function(data){
            var user = JSON.parse(data); JSON으로 받아서 inut 값에 넣어줌
            $("[name='productName']").val(user.forename);
            $("[name='description']").val(user.usr_name);
        }
    })
    $.get({
        url : "rest/model.php",
        data : {mode:'category', id},
        success : function(data){
            //console.log(data)
            $("[name= category]").html(data);
        }
    })
}
const clearForm = ()=> {
    $("input[name='productName']").val("");
    $("[name='description']").val("");
    $("select[name=category]").val("");
    mode = "insert";
    $("#save").attr("value", "입력모드");
}
$(function() {
    //초기값 설정
    let mode = "insert";
    let data;
    var productName;
    var productDescription;
    var category;
    var productImg;
    var id;

    //리스트출력
    loadData();

    $("[name='switch']").click(function(){
		$("#save").attr("value", "스위치");
	})
    //입력
    $("#save").click(function(e) {
        e.preventDefault();
        getValue();
        if(productName == "")
			alert("제품명 입력하세요");
        else if(productName.length < 2 || productName.length > 10)
            alert("2글자 이상, 10글자 이하");
		else if(productDescription=="")
			alert("설명을 입력하세요");
        else
            if(mode=="insert"){
                insertData();
            }else if(mode=="update"){
                updateData();
            }
    });
    //수정
    $("body").on("click", ".edit", function(){
		mode = "update";
        $("#save").attr("value", "수정모드");
        id = $(this).attr("data-id");
        getData(id);
    })
    //삭제
    $("body").on("click", ".delete", function(){
		id = $(this).attr("data-id");
        if(confirm('정말 삭제!?')){
            deleteData(id);
        }
    })

    function insertData(){
        $('#loading').show();
        getValue();
        $.post({
            url : "rest/model.php",
            data : data,
			contentType : false,
			processData: false,
            success : function(res){
                loadData();
            },
            complete : function(){
                $('#loading').hide();
            },
        })
    }

    function getValue(){
        //FormData.append을 사용하여 key/value 쌍을 추가할 수 있습니다
        data = new FormData();
        productName = $("[name='productName']").val();
        productDescription = $("[name='description']").val();
        category = $("[name='category']").val();
        productImg = $("[name='product_img']").prop('files')[0];

        if(productImg==undefined){
            productImg = null;
        }

        data.append("category", category);
        data.append("productName", productName);
        data.append("productDescription", productDescription);
        data.append("productImg", productImg);
        data.append("mode", mode);
        data.append("id", id);
    }
    const updateData = () => {
        $('#loading').show();
        getValue();
        $.post({
            url : "rest/model.php",
            data : data, //수정모드 id=data-id->getValue()data.append("id", id)
            contentType : false,
            processData: false,
            success : function(res){
                loadData();
				clearForm();
            },
            complete : function(){
				$('#loading').hide();
			},
        })
    }
    const deleteData = (id)=> {
        $('#loading').show();
        $.get({
            url : "rest/model.php",
			data : {mode:"delete", id},
            success : function(res){
				loadData();
				clearForm();
                console.log(res)
			},
			complete : function(){
				$('#loading').hide();
			}
        })
    }

}) //endJQ
