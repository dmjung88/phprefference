const getAllData = () => {
    $.ajax({
        dataType: 'json',
        url : 'api/getAllData.php',
    }).done(function(res){
        var	rows = '';
        $.each( res.data, function( key, value ) {
            rows = rows + '<tr>';
            rows = rows + '<td>'+value.forename+'</td>';
            rows = rows + '<td>'+value.surname+'</td>';
            rows = rows + '<td data-id="'+value.id+'">';
            rows += '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
            rows += '<button class="btn btn-danger remove-item">Delete</button>';
            rows = rows + '</td>';
            rows = rows + '</tr>';
        })
        $("tbody").html(rows);
    })
}

$( document ).ready(function() {
    getAllData();

    //입력
    $(".crud-submit").click(function(e){
        e.preventDefault();
        var form_action = $("#create-item").find("form").attr("action");  
        var title = $("#create-item").find("input[name='title']").val();
        var description = $("#create-item").find("textarea[name='description']").val();
        if(title != '' && description != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: form_action,
                data:{title, description}
            }).done(function(data){
                //console.warn(data)
                $("#create-item").find("input[name='title']").val('');
                $("#create-item").find("textarea[name='description']").val('');
                getAllData();
                $(".modal").modal('hide');
                toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
            });
        }else {
            alert('타이틀 내용 기입요망.')
        }
    }) //endFunction

    //삭제
    $("body").on("click",".remove-item",function(){
        var id = $(this).parent("td").data('id');
        var removeRow = $(this).parents("tr");
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: 'api/delete.php',
            data:{id:id}
        }).done(function(data){
            //console.log(data);
            removeRow.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getAllData();
        })
    })
    $("body").on("click",".edit-item",function(){
        var id = $(this).parent("td").data('id');
        var title = $(this).parent("td").prev("td").prev("td").text(); //부모 형 형
        var description = $(this).parent("td").prev("td").text(); //부모 형
        $("#edit-item").find("input[name='title']").val(title);
        $("#edit-item").find("textarea[name='description']").val(description);
        $("#edit-item").find(".edit-id").val(id); 
    });
    $(".crud-submit-edit").click(function(e){
        e.preventDefault();
        var form_action = $("#edit-item").find("form").attr("action");
        var title = $("#edit-item").find("input[name='title']").val();
        var description = $("#edit-item").find("textarea[name='description']").val();
        let id = $("#edit-item").find(".edit-id").val();
        if(title != '' && description != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: form_action,
                data:{title, description, id}
            }).done(function(data){
                //console.info(data);
                getAllData();
                $(".modal").modal('hide');
                toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
            })
        }
    })
}) //document