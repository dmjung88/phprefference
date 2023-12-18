$(document).ready(function() {
    
    fetchTasks(); //리스트
 
    $('#add').click(function(e) {
        e.preventDefault();
        const postData = {
            name: $('#name').val(),
            description : $('#description').val(),
            id : $('#taskId').val()
        };
        $.post('add_pro.php', postData, (response) => {
            //console.log(response)
            $('#task-form').trigger('reset');
            fetchTasks();
        })
    })

    function fetchTasks() {
        $.ajax({
            url: 'list.php',
            type: 'GET',
            dataType:"json", // 옵션 이거안쓰면 JSON.parse()
            success: function(boards) {
                //console.log(boards);
                let template = '';
                boards.forEach(board => {
                    template += `
                    <tr taskId="${board.id}">
                    <td>${board.id}</td>
                    <td>
                    <a href="#" class="task-item">
                      ${board.name} 
                    </a>
                    </td>
                    <td>${board.description}</td>
                    <td>
                      <button type="button"  class="task-delete btn btn-danger">
                       Delete 
                      </button>
                      <button class="task-item">상세보기</button>
                    </td>
                    </tr>
                  `
                    });
                $('#task-result').show();
                $('#container').html(template);
            }
        })
    } //endFunction

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'search.php',
                data: { search},
                type: 'POST',

                success: function (response) {
                    if(!response.error) {
                        //console.log(response)
                        let boards = JSON.parse(response);
                        let template = '';
                        boards.forEach(board => {
                            template += `
                                   <li><a href="#" class="task-item">${board.name}</a></li>
                                  ` 
                            });
                            $('#task-result').show();
                            $('#container').html(template);
                    }
                }
            })
        }
    }) //endFunction

    $('#update').on("click", function(e) {
        e.preventDefault();
        const postData = {
            name: $('#name').val(),
            description : $('#description').val(),
            id : $('#taskId').val()
        };
        $.post('edit.php', postData, (response) => {
            //console.log(response)
            $('#task-form').trigger('reset');
            fetchTasks();
        })
    })
    $(document).on('click', '.task-delete', () => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('taskId');
        if(confirm('정말삭제?')) {
            $.post('delete.php', {id}, (response) => {
                console.log(response);
                fetchTasks();
            });
        }
    })
    $('#test').click(function() {
        alert($(this).attr('data-id'))
        alert($(this).data('id'))
        alert($.data(this, 'id'));
        alert($(this).data().id);
    })

    $(document).on('click', '.task-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('taskId');
            $.post('single.php', {id}, (response) => {
                var board = JSON.parse(response);
                console.log(board)

                fetchTasks();
        })
    })

})//doc