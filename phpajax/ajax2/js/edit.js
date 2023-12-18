$(document).ready(function(){
    function get_edit_id(){ //쿼리스트링 get id
        let url = new URLSearchParams(window.location.search);
        let id = url.get('id');
        id = parseInt(id);
        return id;
    }
    function get_rows(){
        $.get(
            "inc/get.php",
            {id : get_edit_id()},
            function(data){
				data = JSON.parse(data);				
				//console.log(data);
                $("#upd_first").val(data.forename);
				$("#upd_last").val(data.surname);
				$("#upd_work").val(data.joined);
				$("#upd_city").val(data.picture);
				$("#upd_email").val(data.email);
			});
    }
    if(get_edit_id()){
		get_rows();
	}
    $("#editForm").submit(function(e){
		e.preventDefault();
		$.ajax({
            type: "POST",
            url:"inc/update.php",
            data: {
                id:get_edit_id() ,first : $('#upd_first').val(),last : $('#upd_last').val()
            },      
        }).done(function(data){
            //console.log(data)
            $("#upd_first").val('');
            $("#upd_last").val('');
            $("#upd_work").val('');
            $("#upd_city").val('');
            $("#upd_email").val('');
            $("#table").load("inc/load.php");
            $("#msgEdit").html("<p class='text-center alert alert-success'>"+data+"</p>");
            $("#msgEdit").slideDown(1000);
        })

    })

})//ready