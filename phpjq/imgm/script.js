const fetchData = () => { 
    $.ajax({
        url: "config/class.php?action=fetchData",
        type: "POST",
        dataType: "json",
        success: function(res) {
            //console.log(res)
            var data = res.data;
            var str = "";
            
            //for(let i=0; i< data.length; i++) {
            for(let i in data) {
                const userphoto = data[i].picture ? data[i].picture : "default_profile.jpg";
                str +=`
                <tr>
                <td class="align-middle"><img src="images/${userphoto}" height='50' width='90' class="img-thumbnail rounded float-left"></td>
                <td class="align-middle">${data[i].forename}</td>
                <td class="align-middle">${data[i].surname}</td>
                <td class="align-middle">${data[i].email}</td>
                <td class="align-middle">${data[i].is_active}</td>
                <td class="align-middle">${data[i].role_id}</td>
                <td class="align-middle">${data[i].id}</td>
                <td class="align-middle">
                <Button type="button" class="btn editBtn" value="${data[i].id}"><i class="fa-solid fa-pen-to-square fa-xl"></i></Button>
                <Button type="button" class="btn deleteBtn" value="${data[i].id}"><i class="fa-solid fa-trash fa-xl"></i></Button>
                <input type="hidden" class="delete_image" value="${data[i].picture}">
                </td>
                </tr>`;
			} 
            $("#noDataTable").html(str);
        }
    })
}

$(document).ready(function() {
    //리스트출력
    fetchData();

    $("#insertForm").on("submit", function(e) {
        $("#insertBtn").attr("disabled", "disabled"); //일단 submit 버튼 정지
        e.preventDefault();
        $.ajax({
            url: "config/class.php?action=insertData",
            type:'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(rs) {
                $("#offcanvasAddUser").offcanvas("hide");
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                $(".preview_img").attr("src", "images/default_profile.jpg");
                var response = JSON.parse(rs);
                if (response.statusCode == 200) {
                    $("#successToast").toast("show");
                    $("#successMsg").html(response.message);
                    fetchData();
                } else if(response.statusCode == 500 || response.statusCode == 400) {
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);
                }
            }
        })
    }) //endFunction
    //사진 미리보기
    $("input.image").change(function() { 
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        $(this).closest(".row").find(".preview_img").attr("src", url);
    });
    $("#myTable").on("click", ".editBtn", function() {
        $.ajax({
            url: "config/class.php?action=fetchSingle",
            type: "POST",
            dataType: "json",
            data: {id: $(this).val()},
            success: function(response) {
                console.log(response)
            }
        })
    })
    $("#myTable").on("click", ".deleteBtn", function() {
        if(confirm("찐삭제>??")) {
            var id = $(this).val();
            var delete_image = $(this).closest("td").find(".delete_image").val();
            $.ajax({
                url: "config/class.php?action=deleteData",
                type: "POST",
                dataType: "json",
                data: { id, delete_image },
                success: function(response) {
                    console.log(response)
                    if(response.statusCode == 200) {
                        fetchData();
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);
                    } else if(response.statusCode == 500) {
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                }
            })
        }
    }) //endFunction

}) //document