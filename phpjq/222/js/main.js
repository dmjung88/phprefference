const loadData = ()=> {
    $.ajax({
        url: 'class/allRead.php',
        method: 'GET',
        success: function (responce) {
            var res = $.parseJSON(responce); //J쿼리 3버전 미만
            if (res.status == 'success') {
                $('#dataTable').html(res.table);
            }
        }
    })
}

//유효성
function validate(form){
    var inputTag = form.find('input');
    for(let i = 0; i< inputTag.length; i++){
        if(inputTag[i].value == '' || inputTag[i].value == null){
            return false;
        }
    }
    return true;
}


$(document).ready(function () {
    loadData();

    $('.createForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(".createForm");

        if(validate(form)){
            createData(form.serialize());
        } else {
            $('#alert2').addClass('alert alert-warning')
            .html('모두기입 요망!!');
        }
    });
    function createData(formData) {
        $.ajax({
            url: 'class/store.php',
            type :'post',
            data: formData,
            success: function (responce) {
                let res = $.parseJSON(responce);
                if (res.status == 'success') {
                    $('#alert').addClass('alert alert-success')
                    .text(res.message)
                    $('.modal').each(function () {
                        $(this).modal('hide');
                    });
                    $("#alert").fadeTo(2000, 500).slideUp(500, function () {
                        $("#alert").slideUp(500);
                    });
                } else {
                    $('#alert').addClass('alert alert-danger').text(res.message)
                }
                loadData();
            }
        })
    } //endFunction

    //액션 버튼
    $('table').on('click', function (e) {
        e.preventDefault();
        //수정버튼
        var editTag = $(e.target).parent('#update');
        var editId = editTag.attr('data-id');
        if (editTag.hasClass('edit')) {
            editData(editId);
        }
        //삭제버튼
        var deleteTag = $(e.target).parent('#delete');
        var deleteId = deleteTag.attr('data-id');
        if (deleteTag.hasClass('delete')) {
            deleteData(deleteId);
        }
        //상세보기버튼
        var showTag = $(e.target).parent('#view');
        var showId = showTag.attr('data-id');
        if (showTag.hasClass('view')) {
            viewData(showId);
        }
    })
    
    //수정클릭시
    function editData(id) {
        $.ajax({
            url: 'class/edit.php',
            method: 'post',
            data: {id: id},
            success: function (responce) {
                var rs = JSON.parse(responce);
                var form = $('#editModal').find('.editForm');
                form.find('[name= id ]').val(rs[0].id);
                form.find('#fname2').val(rs[0].forename);
                form.find('#lname2').val(rs[0].surname);
                form.find('#email2').val(rs[0].email);
                if(rs[0].is_active == '0'){
                    form.find('#genderM2').filter("[value='male']").attr('checked', true);
                } else {
                    form.find('#genderO2').filter("[value='other']").attr('checked', true);
                }
            }
        })
    }
    //POST 수정
    $('.editForm').on('submit', function (e) {
        e.preventDefault();
        if(validate($(this))){
            updateData($(this).serialize());
        }else {
            $('#alert3').addClass('alert alert-warning')
            .html('수정폼기입해!');
        }
    })
    const updateData = (data) => {
        $.ajax({
            url: 'class/update.php',
            type: 'POST',
            data: data,
            success: function (responce) {
                var rs = $.parseJSON(responce);
                if (rs.status == 'success') {
                    $('#alert').addClass('alert alert-success')
                    .html(rs.message);
                    $('.modal').each(function () {
                        $(this).modal('hide');
                    })
                    $("#alert").fadeTo(2000, 500).slideUp(500, function () {
                        $("#alert").slideUp(500);
                    });
                } else {
                    $('#alert').addClass('alert alert-danger').html(rs.message);
                }
                // 리스트 출력
                loadData();
            }
        })
    } //EndFunction
   
    function deleteData(id) {
        $('.deleteForm').on('submit', function (e) {
            e.preventDefault();  
            console.log(id);
            $.ajax({
                url: 'class/delete.php',
                method: 'post',
                data: { id },

                success: function (responce) {
                    var rs = JSON.parse(responce);
                    console.log(rs)
                }
            })
        })
    }

    function viewData(id) {
        $.ajax({
            url :'class/view.php',
            method:'post',
            data :{ id:id },
            success: function (responce) {
                var rs = $.parseJSON(responce);
                console.log(rs)
                if (rs.status == 'success') {
                    $('#viewModal').find('#fname4').html(rs[0].forename);
                    $('#viewModal').find('#lname4').html(rs[0].surname);
                }
            }
        })
    }
}) //endJQ