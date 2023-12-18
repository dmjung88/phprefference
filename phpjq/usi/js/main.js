$(function() {
    $(document).on("click", "a.profile", function () {
        $.ajax({
            url: "phpcrudajax/ajax.php",
            type: "GET",
            dataType: "json",
            data: { id: $(this).data("id"), action: "getuser" },
            success: function (player) {
                //console.info(player)
                const userphoto = player.picture ? player.picture : "default.png";
                var profile = `<div class="row">
                <div class="col-sm-6 col-md-4">
                  <img src="uploads/${userphoto}" class="rounded responsive" />
                </div>
                <div class="col-sm-6 col-md-8">
                  <h4 class="text-primary">${player.forename}</h4>
                  <p class="text-secondary">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i> ${player.surname}
                    <br />
                    <i class="fa fa-phone" aria-hidden="true"></i> ${player.email}
                  </p>
                </div>
              </div>`;
                $('#profile').html(profile);
            }
        })
    })
    $("#searchinput").on("keyup", function () {
        var searchText = $(this).val();
        if (searchText.length > 1) {
            $.ajax({
                url :"phpcrudajax/ajax.php",
                type : 'get',
                dataType : 'json',
                data: { searchText , action: "search" },
                success: function (players) {
                    console.info(players)
                    let playerslist = '';
                    $.each(players, function (index, player) {
                        playerslist += getplayerrow(player);
                    });
                    $("#userstable tbody").html(playerslist);
                    $("#pagination").hide();
                },
                error: function (err) {
                    console.debug(err);
                },
            })
        }
    })
}) //endJQ