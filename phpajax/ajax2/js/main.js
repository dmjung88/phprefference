$(document).ready(function(){
    $("#table").load("inc/load.php"); //동적으로 페이지의 내용을 교체

    $("#regForm").submit(function(e){
        e.preventDefault();
        $.ajax({
			type: "POST",
			url:"inc/store.php",
			data: $(this).serialize(),
		})
        .done(function(data){
            //console.log(data);
            $("#table").load("inc/load.php"); //html() 랑 비슷
            $("#first").val('');
            $("#last").val('');
            $("#work").val('');
            $("#city").val('');
            $("#email").val('');
            $("#msgReg").html("<p class='text-center alert alert-success'>"+data+"</p>");
            $("#msgReg").slideDown(1400);
            setTimeout(function(){
                $("#msgReg").slideUp(900);
			},900)
            
        })
    })

    $("[name=q]").keyup(function(){
        $("#msg").hide();
        let q = $("[name=q]").val();
        if(q !=''){
            $("#table").html('');
            $.ajax({
                type:"POST",
                url:"inc/search.php",
                data:{q:q},
                success:function(data){
                    $("#table").html(data);
                }
            })
        }else {
            $("#table").load("inc/load.php");
        }
    })
    //$(document).on('click', '.del', () => {
    $(document).on('click', '.del', function() {
        var id = ($(this).attr('data-id'))
        // console.log($(this).data('id'))
        // console.log($.data(this, 'id'));
        // console.log($(this).data().id);
        $.ajax({
            type:"POST",
            url:"inc/delete.php",
            data:{id},
            success:function(data){
                console.log(data)
                $("#table").load("inc/load.php");
            }
        })
    })
}) //ready