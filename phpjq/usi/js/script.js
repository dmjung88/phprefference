//  페이징
function pagination(totalpages, currentpage) {
    var pagelist = "";
    if (totalpages > 1) {
        currentpage = parseInt(currentpage);
        pagelist += `<ul class="pagination justify-content-center">`;
        const prevClass = currentpage == 1 ? " disabled" : "";
        pagelist += `<li class="page-item${prevClass}"><a class="page-link" href="#" data-page="${
            currentpage - 1
          }">Previous</a></li>`;
        for (let p = 1; p <= totalpages; p++) {
        const activeClass = currentpage == p ? " active" : "";
        pagelist += `<li class="page-item${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
        }
        const nextClass = currentpage == totalpages ? " disabled" : "";
        pagelist += `<li class="page-item${nextClass}"><a class="page-link" href="#" data-page="${
          currentpage + 1
        }">Next</a></li>`;
        pagelist += `</ul>`;
    }   
    $("#pagination").html(pagelist); 
}

function getplayers() {
    $.ajax({
        url: "phpcrudajax/ajax.php",
        type: "GET",
        dataType: "json",
        data: { page: $("#currentpage").val(), action: "getusers" },
        beforeSend: function () {
            $("#overlay").fadeIn();
        },
        success: function (res) {
            //console.log(res)
            if (res.players) {
                var playerslist = "";
                $.each(res.players, function (index, player) {
                    playerslist += getplayerrow(player);
                });
                $("#userstable tbody").html(playerslist);
                let totalPlayers = res.count;
                let totalpages = Math.ceil(parseInt(totalPlayers) / 4);
                const currentpage = $("#currentpage").val();
                pagination(totalpages, currentpage);
                $("#overlay").fadeOut();
            }
        },
        error: function (err) {
            console.log(err)
        },
    })
} //endFunction

function getplayerrow(player) {
    const userphoto = player.picture ? player.picture : "default.png";
    playerRow = `<tr>
    <td class="align-middle"><img src="uploads/${userphoto}" class="img-thumbnail rounded float-left"></td>
    <td class="align-middle">${player.forename}</td>
    <td class="align-middle">${player.surname}</td>
    <td class="align-middle">${player.email}</td>
    <td class="align-middle">
      <a href="#" class="btn btn-success mr-3 profile" data-toggle="modal" data-target="#userViewModal"
        title="Prfile" data-id="${player.id}"><i class="fa fa-address-card-o" aria-hidden="true"></i></a>
      <a href="#" class="btn btn-warning mr-3 edituser" data-toggle="modal" data-target="#userModal"
        title="Edit" data-id="${player.id}"><i class="fa fa-pencil-square-o fa-lg"></i></a>
      <a href="#" class="btn btn-danger deleteuser" title="Delete" data-id="${player.id}"><i
          class="fa fa-trash-o fa-lg"></i></a>
        </td>
     </tr>`;
    return playerRow;

}

$(document).ready(function () {
    //리스트출력
    getplayers();
    // 페이징
    $(document).on("click", "ul.pagination li a", function (e) {
        e.preventDefault();
        var $this = $(this);
        const pagenum = $this.data("page");
        $("#currentpage").val(pagenum);
        getplayers();
        $this.parent().siblings().removeClass("active");
        $this.parent().addClass("active");
    });
    $(document).on("submit", "#addform", function (event) {
        event.preventDefault();
        var alertmsg = $("#userid").val().length > 0 ? '업데이트 성공': '새로생성 성공';
        $.ajax({
            url: "phpcrudajax/ajax.php",
            type: "POST",
            dataType: "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#overlay").fadeIn();
            },
            success: function (response) {
                //console.log(response);
                if (response) {
                    $("#userModal").modal("hide");
                    $("#addform")[0].reset();
                    $(".message").html(alertmsg).fadeIn().delay(3000).fadeOut();
                    getplayers();
                    $("#overlay").fadeOut();
                }
            },
            error: function (err) {
                console.log('에러 : ',err);
            },
        })
    }) //endFunction

    $(document).on("click", "a.edituser", function () {
        $.ajax({
            url: "phpcrudajax/ajax.php",
            type: "GET",
            dataType: "json",
            data: { id: $(this).data("id"), action: "getuser" },
            beforeSend: function () {
              $("#overlay").fadeIn();
            },
            success: function (result) {
                //console.log(result)
                $("#username").val(result.forename);
                $("#email").val(result.email);
                $("#phone").val(result.surname);
                $("#userid").val(result.id);
                $("#overlay").fadeOut();
            },
            error: function (err) {
                console.log("에러 : " + err);
            }
        })
    })

    //글쓰기 폼 리셋
    $("#addnewbtn").on("click", function () {
        $("#addform")[0].reset();
        $("#userid").val("");
    });
}) //endJQ