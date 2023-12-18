<!doctype html>
<html lang="en">

<head>
  <title>AJAX CRUD Operation - ITLogiko</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="js/lib/bootstrap.min.css">
  <link rel="stylesheet" href="js/lib/fontawesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="js/lib/custom.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">AJAX CRUD </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home </a>
        </li>
      </ul>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
        <i class="glyphicon glyphicon-plus"></i>Create Data
      </button>
    </div>
  </nav>
  <!-- Notifications -->
  <div class="" id="alert"></div>
  <!-- 데이타 테이블 -->
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#ID</th>
        <th>forename</th>
        <th>surname</th>
        <th>email</th>
        <th>is_active</th>
        <th>role_id</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody id="dataTable">
        <!-- 데이타 -->
    </tbody>
</table>

  <!-- Create Modal -->
  <div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="" id="alert2"></div>
          <form method="post" action="class/store.php" class="form-group add-form createForm">
            <div class="form-row">
              <div class="col">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname1" value="" class="form-control" onblur="nameCheck()" placeholder="Mr Example">
              </div>
              <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname1" value="" class="form-control" onblur="nameCheck()" placeholder="Dgi">
              </div>
            </div> 
            <span id="wfname"></span>
            <div class="form-row"> 
              <div class="col">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email1" value="" class="form-control" onblur="validateemail()" required placeholder="example@example.com">
              </div>
            </div>
            <span id="wemail"></span>
            <div class="form-row">
              <div class="col">
                <label for="password1">Password</label>  
                <input type="password" name="password" id="password11" value="" class="form-control" onblur="passVal()" autocomplete="true" required>
              </div>
              <div class="col">
                <label for="password2">Password again</label>
                <input type="password" name="password2" id="password21" value="" class="form-control" onblur="passVal()" autocomplete="true" required>
              </div>
            </div>
            <span id="wpass"></span>
            <div class="row">
              <label for="gender" class="col pt-3">Gender</label>
              <div class="col pt-3"><input type="radio" name="gender" value="male" id="gender1" checked> Male
              </div>
              <div class="col pt-3"><input type="radio" name="gender" value="female" id="genderF1"> Female</div>
              <div class="col pt-3"><input type="radio" name="gender" value="gender" id="genderO1"> Others</div>
            </div>
            <div class="row pt-2">
              <div class="col pt-2">
                <label for="dob">Date of Birth</label>
              </div>
              <div class="col pt-2">
                <input type="date" name="dob" id="dob1" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="edu">Education</label>
                <input type="text" name="education" id="edu1" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="address">Address</label>
                <input type="text" name="address" id="address1" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="bio">Bio</label>
                <input type="text" name="bio" id="bio1" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col pt-3"><input type="checkbox" name="agr" id="agr1" onchange="document.querySelector('#createData1').disabled = !this.checked;"> Do you agree?</div>
            </div>
            <div class="row">
              <div class="col pt-4">
                <input type="submit" value="submit" name="submit" id="createData1" class="btn btn-success btn-lg btn-block" disabled>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  <div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="" id="alert3"></div>
          <form method="post" action="class/update.php" class="form-group editForm">
            <div class="form-row">
              <div class="col">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname2" value="" class="form-control">
              </div>
              <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname2" value="" class="form-control">
              </div>
            </div>
            <span id="wfname"></span>
            <div class="form-row">
              <div class="col">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email2" class="form-control" required>
              </div>
            </div>
            <span id="wemail"></span>
            <div class="row">
              <label for="gender" class="col pt-3">Gender</label>
              <div class="col pt-3"><input type="radio" name="gender" value="male" id="genderM2"> Male
              </div>
              <div class="col pt-3"><input type="radio" name="gender" value="female" id="genderF2"> Female</div>
              <div class="col pt-3"><input type="radio" name="gender" value="other" id="genderO2"> Others</div>
            </div>
            <div class="row pt-2">
              <div class="col pt-2">
                <label for="dob">Date of Birth</label>
              </div>
              <div class="col pt-2">
                <input type="date" name="dob" id="dob2" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="edu">Education</label>
                <input type="text" name="education" id="education2" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="address">Address</label>
                <input type="text" name="address" id="address2" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="bio">Bio</label>
                <input type="text" name="bio" id="bio2" class="form-control">
                <input type="hidden" name="id" >
              </div>
            </div>
            <div class="row">
              <div class="col pt-4">
                <input type="submit" value="submit" name="submit" id="createData2" class="btn btn-success btn-lg btn-block">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade bd-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h3>찐삭제?</h3>
          <form method="post" class="form-group deleteForm" >
            <div class="row">
              <div class="col pt-4">
                <input type="submit" value="Delete" name="submit" id="createData3" class="btn btn-danger btn-lg btn-block">
              </div>
            </div>
          </form>
          <button type="button" class="btn btn-secondary btn-lg btn-block" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal  view-->
  <div class="modal fade bd-example-modal-lg" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">View Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table>
            <tbody>
              <tr>
                <td>
                  First Name
                </td>
                <td>
                   : 
                </td>
                <td>
                  <b id="fname4" class="showdata"></b>
                </td>
              </tr>
              <tr>
                <td>
                  Last Name
                </td><td> : </td>
                <td>
                  <b id="lname4" class="showdata"></b>
                </td>
              </tr>
              <tr>
                <td>
                  Email Address
                </td><td> : </td>
                <td>
                  <b id="email4" class="showdata">
                </td>
              </tr>
              <tr>
                <td>
                  Gender
                </td><td> : </td>
                <td>
                  <b id="gender4"></b>
                </td>
              </tr>
              <tr>
                <td>
                  Date of Birth
                </td><td> : </td>
                <td>
                  <b id="dob4"></b>
                </td>
              </tr>
              <tr>
                <td>
                  Education
                </td><td> : </td>
                <td>
                  <b id="education4"></b>
                </td>
              </tr>
              <tr>
                <td>
                  Address
                </td><td> : </td>
                <td>
                  <b id="address4"></b>
                </td>
              </tr>
              <tr>
                <td>
                  Bio
                </td><td> : </td>
                <td>
                  <b id="bio4"></b>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/lib/jquery.js"></script>
  <script src="js/lib/popper.min.js"></script>
  <script src="js/lib/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
<script>

//이름 글자수 유효성
const nameCheck =() => {
  var fnameLength = $('[name=fname]').val().length;
  var lnameLength = $('[name=lname]').val().length;
  var fullName = $('[name=fname]').val() + $('[name=lname').val();

  if (fullName.length > 30 || fullName.length <= 2) {
    document.querySelector('#wfname').innerHTML = "이름은 2자이상 30자 이하";
    $('[name=fname]').addClass('is-invalid');
    $('[name=lname]').addClass('is-invalid');
  } else {
    document.getElementById('wfname').innerHTML = "";
    $('[name=fname]').removeClass('is-invalid');
    $('[name=lname]').removeClass('is-invalid');

  }
}  

//이메일 유효성
function validateemail() {
  var atposition = $('[name=email]').val().indexOf("@");
  var dotposition = $('[name=email]').val().lastIndexOf(".");
  if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= $('[name=email]').val().length) {
    $('#wemail').html('유효한 이메일을 입력해라');
    $("[name=email]").removeClass('is-valid');
    $("[name=email]").addClass('is-invalid');
  } else {
    $('#wemail').text('유효성공');
    $("[name=email]").removeClass('is-invalid');
    $("[name=email]").addClass('is-valid');
  }

} 
//비밀번호 유효성 + 확인
const passVal = function() {
  let passLen = document.getElementsByName('password')[0].value.length;
  if (passLen > 30 || passLen < 6) {
    $('#wpass').html('비밀번호는 6자이상 30자 이하');
    $("[name=password]").removeClass('is-valid').addClass('is-invalid');
    isPass = true;
  } else {
    $('#wpass').text('');
    $("[name=password]").removeClass('is-invalid').addClass('is-valid');
  }
  if ($('[name=password]').val() !== $('[name=password2]').val()) {
    $('#wpass').text('비밀번호가 일치하지않아요.');
  }
}

function modalHide() {
  $('.modal').each(function () {
      e.preventDefault();
      $(this).modal('hide');
  });
}

</script>
</body>

</html>