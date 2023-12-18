<?php include('inc/header.php'); ?>

<div class="container-fluid">
		<div class="container">
			<div class="row m-3 text-center">
				<div class="col-lg-12">
					<h1 class="box-title">Ajax Insert || Update || Delete</h1>
				</div>
			</div>
			<div  class="row justify-content-center">
				<div class="col-lg-6">
				<button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModalCenter" >Add Record</button>	
				</div>
				<div class="col-lg-6">
					<input type="text" id="search" class="form-control" placeholder="Search Now">
				</div>
			</div>
			<div class="row mt-5" id="tbl_rec">
    
			</div>
		</div>
	</div>
	
<!-- Insert Design Modal -->
	
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="ins_rec">
	      <div class="modal-body">
			  	<div class="form-group">
					<label><b>User Name</b></label>
					<input type="text" name="username" class="form-control" placeholder="Username">
					<span class="error-msg" id="msg_1"></span>
			  	</div>
			  	<div class="form-group">
					<label><b>Email</b></label>
					<input type="text" name="email" class="form-control" placeholder="YourEmail@email.com">
					<span class="error-msg" id="msg_2"></span>
			  	</div>
				<div class="form-group">
					<label><b>Country</b></label>
					<select class="custom-select" name="country" id="country">
						<option value="" selected>Choose...</option>
						<option value="USA">USA</option>
						<option value="Germany">Germany</option>
						<option value="UK">UK</option>
					</select>
					<span class="error-msg" id="msg_3"></span>
			  	</div>
				<div class="form-group">
					<label><b>Birth Date</b></label>
					<input type="date" name="bod" class="form-control">
					<span class="error-msg" id="msg_4"></span>
			  	</div>
				<div class="form-group">
					<label class="mr-3"><b>Gender :- </b></label>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="gender" value="Male" checked>
					  <label class="form-check-label" >Male</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="gender" value="Female">
					  <label class="form-check-label" >Female</label>
					</div>
					<span class="error-msg"  id="msg_5"></span>
				</div>	
				<div class="form-group">
					<span class="success-msg" id="sc_msg"></span>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" id="close_click" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary" >Add Record</button>
	      </div>
      </form>
    </div>
  </div>
</div>
	
<!-- End Insert Modal -->
		
<!-- Update Design Modal -->
	
<div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalCenterTitle">Update Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="updata">
      <div class="modal-body">
		  	<div class="form-group">
				<label><b>User Name</b></label>
				<input type="text" class="form-control" name="username" id="upd_1" placeholder="Username">
				<span class="error-msg" id="umsg_1"></span>
		  	</div>
		  	<div class="form-group">
				<label><b>Email</b></label>
				<input type="text" class="form-control" name="email" id="upd_2" placeholder="YourEmail@email.com">
				<span class="error-msg" id="umsg_2"></span>
		  	</div>
			<div class="form-group">
				<label><b>Country</b></label>
				<select class="custom-select" id="upd_3" name="country">
					<option value="" selected>Choose...</option>
					<option value="USA">USA</option>
					<option value="Germany">Germany</option>
					<option value="UK">UK</option>
				</select>
				<span class="error-msg" id="umsg_3"></span>
		  	</div>
			<div class="form-group">
				<label><b>Birth Date</b></label>
				<input type="date" class="form-control" id="upd_4" name="bod">
				<span class="error-msg" id="umsg_4"></span>
		  	</div>
			<div class="form-group">
				<label><b>Gender</b></label>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="upd_5" name="gender" value="Male">
				  <label class="form-check-label" >Male</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" id="upd_6" name="gender" value="Female">
				  <label class="form-check-label" >Female</label>
				</div>
				<span class="success-msg" id="umsg_5"></span>
			</div>
			<div class="form-group">
				<input type="hidden" name="dataval" id="upd_7">
				<span class="success-msg" id="umsg_6"></span>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="up_cancle">Cancle</button>
        <button type="submit" class="btn btn-primary">Update Record</button>
      </div>
      </form>	
    </div>
  </div>
</div>	
	
<!-- End Update Design Modal -->
	
<!-- Delete Design Modal -->
	
<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalCenterTitle">Are You Sure Delete This Record ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <p>진짜 삭제할거야?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="de_cancle" data-dismiss="modal">Cancle</button>
        <button type="button" class="btn btn-primary" id="deleterec">Delete Now</button>
      </div>
    </div>
  </div>
</div>	                                
<script type="text/javascript">
$(document).ready(function (){
    $('#tbl_rec').load('record.php');

    $('#search').keyup(function (){
        $('#tbl_rec').load('record.php', {keyword: $(this).val()});
    })

    $('#ins_rec').on("submit", function(e){
        e.preventDefault();
		$.ajax({
            type:'POST',
			url:'store.php',
            data:$(this).serialize(),
			success:function(res){
                var json = JSON.parse(res);
                if(json.status == 101){
                    console.log(json.msg);
                    $('#tbl_rec').load('record.php');
                    $('#ins_rec').trigger('reset');
                    $('#close_click').trigger('click');
                } else if (json.status == 102)
                    $('#sc_msg').text(json.msg);
                else if(json.status == 103)
                    $('#msg_1').text(json.msg);
                else
                    console.log(json.msg);
            }
        })
    })
    $(document).on("click", "button.editdata", function(){
        var id = $(this).data('dataid');
        $.getJSON("update.php", {id}, function(json){
            if(json.status == 0){
                $('#upd_7').val(id);
                if(json.msg == 'Fail'){
					$('#upd_5').prop("checked", true);
				} else {
                    $('#upd_6').prop("checked", true);
                }
            }else  console.log(json.msg);
        })
    })
    $('#updata').on("submit", function(e){
		e.preventDefault();
        $.ajax({
            type:'POST',
			url:'update.php',
			data:$(this).serialize(),
            success:function(res){
                console.log(res)
                var json = JSON.parse(res);
                if(json.status == 101){
                    console.log(json.msg);
                    $('#tbl_rec').load('record.php');
					$('#ins_rec').trigger('reset');
					$('#up_cancle').trigger('click');
                }else if(json.status == 102)
                    $('#umsg_6').text(json.msg);
                else
                    console.log(json.msg);
            }
        })
    })
    //삭제
    let deleteid;
    $(document).on("click", "button.deletedata", function(){
        deleteid = $(this).data("dataid");
    });
    $('#deleterec').click(function (){
        $.ajax({
            type:'POST',
			url:'delete.php',
            data:{delete_id : deleteid},
            success:function(data){
                var json = JSON.parse(data);
                if(json.status == 0){
                    $('#tbl_rec').load('record.php');
                    $('#de_cancle').trigger("click");
                }else {
                    console.log(json.msg);
                }

            }
        })
    })
}) //ready
</script>