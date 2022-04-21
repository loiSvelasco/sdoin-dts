  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3">
            <div class="card">
              <div class="card-header border-warning">Change Password</div>
              <div class="card-body">
              <form action="actions/changepwd.php" method="post" oninput="newPass1.setCustomValidity(newPass1.value != newPass.value ? 'Passwords do not match.' : '')">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Current Password</span>
                  </div>
                  <input type="password" class="form-control" aria-label="Sizing example input" name="currPass" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <hr>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">New Password</span>
                  </div>
                  <input type="password" class="form-control" aria-label="Sizing example input" name="newPass" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Confirm</span>
                  </div>
                  <input type="password" class="form-control" aria-label="Sizing example input" name="newPass1"aria-describedby="inputGroup-sizing-default" required>
                </div>
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Save</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
