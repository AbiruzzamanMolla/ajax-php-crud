<!doctype html>
<html lang="en">

<head>
  <title>CRUD Operation - ITLogiko</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/custom.css">
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
  <!-- Data Table -->
  <table class="table table-bordered" id="dataTable">
  </table>


  <!-- Create Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form method="post" action="bend/add.php" class="form-group add-form" id="form1">
            <div class="form-row">
              <div class="col">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" value="" class="form-control" onblur="nameCheck()" placeholder="Mr Example">
              </div>
              <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" value="" class="form-control" onblur="nameCheck()" placeholder="Dgi">
              </div>
            </div>
            <span id="wfname"></span>
            <div class="form-row">
              <div class="col">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="" class="form-control" onblur="validateemail()" required placeholder="example@example.com">
              </div>
            </div>
            <span id="wemail"></span>
            <div class="form-row">
              <div class="col">
                <label for="password1">Password</label>
                <input type="password" name="password" id="password1" value="" class="form-control" onblur="passVal()" autocomplete="true" required>
              </div>
              <div class="col">
                <label for="password2">Password again</label>
                <input type="password" name="password2" id="password2" value="" class="form-control" onblur="passVal()" autocomplete="true" required>
              </div>
            </div>
            <span id="wpass"></span>
            <div class="row">
              <label for="gender" class="col pt-3">Gender</label>
              <div class="col pt-3"><input type="radio" name="gender" value="male" id="gender" checked> Male
              </div>
              <div class="col pt-3"><input type="radio" name="gender" value="female" id="genderF"> Female</div>
              <div class="col pt-3"><input type="radio" name="gender" value="gender" id="genderO"> Others</div>
            </div>
            <div class="row pt-2">
              <div class="col pt-2">
                <label for="dob">Date of Birth</label>
              </div>
              <div class="col pt-2">
                <input type="date" name="dob" id="dob" class="form-control" onchange="checkForm()">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="edu">Education</label>
                <input type="text" name="education" id="edu" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="bio">Bio</label>
                <input type="text" name="bio" id="bio" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col pt-3"><input type="checkbox" name="agr" id="agr" onchange="document.querySelector('#createData').disabled = !this.checked;"> Do you agree?</div>
            </div>
            <div class="row">
              <div class="col pt-4">
                <input type="submit" value="submit" name="submit" id="createData" class="btn btn-success btn-lg btn-block" disabled>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" class="form-group" id="form1">
            <div class="form-row">
              <div class="col">
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" value="" class="form-control" onblur="nameCheck()">
              </div>
              <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" value="" class="form-control" onblur="nameCheck()">
              </div>
            </div>
            <span id="wfname"></span>
            <div class="form-row">
              <div class="col">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" onblur="validateemail()" required>
              </div>
            </div>
            <span id="wemail"></span>
            <div class="row">
              <label for="gender" class="col pt-3">Gender</label>
              <div class="col pt-3"><input type="radio" name="gender" value="male" id="gender" checked> Male
              </div>
              <div class="col pt-3"><input type="radio" name="gender" value="female" id="genderF"> Female</div>
              <div class="col pt-3"><input type="radio" name="gender" value="gender" id="genderO"> Others</div>
            </div>
            <div class="row pt-2">
              <div class="col pt-2">
                <label for="dob">Date of Birth</label>
              </div>
              <div class="col pt-2">
                <input type="date" name="dob" id="dob" class="form-control" onchange="checkForm()">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="edu">Education</label>
                <input type="text" name="education" id="edu" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <label for="bio">Bio</label>
                <input type="text" name="bio" id="bio" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col pt-4">
                <input type="submit" value="submit" name="submit" id="createData" class="btn btn-success btn-lg btn-block">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" class="form-group" id="form1">

            <div class="row">
              <div class="col pt-4">
                <input type="submit" value="submit" name="submit" id="createData" class="btn btn-success btn-lg btn-block">
              </div>
            </div>
          </form>
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
</body>

</html>