
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="?admin">Administration</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <div class="content">
      <div class="container-fluid">
      <?php display_notice();?>
      </div>
        <div class="row">
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-header border-info bg-white">
                <h3 class="card-title">Manage Users</h3>
              </div>

              <div class="card-body bg-white">
                <table id="adminTables" class="table table-bordered table-sm table-hover table-responsive-xl">
                  <thead>
                    <tr>
                      <th class="col-1 text-center">#</th>
                      <th class="d-none">realID</th>
                      <th class="col-3">Email</th>
                      <th class="col-3">Full Name</th>
                      <th class="col-2">Role</th>
                      <th class="d-none">Role</th>
                      <th class="col-2">Unit</th>
                      <th class="d-none">Unit</th>
                      <th class="d-none">Locked</th>
                      <th class="col text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    allUsers();
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>

          <div class="col-lg-4 col-12">
            <div class="card">
              <div class="card-header border-info bg-white">
                <h3 class="card-title">Add a user</h3>
              </div>
  
              <div class="card-body bg-white">
                <form action="actions/register.php" method="post" oninput="password2.setCustomValidity(password2.value != password.value ? 'Passwords do not match.' : '')">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" name="fullname" required autofocus>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <select class="form-control select2" placeholder="School/Unit" name="unit" required>
                        <option value="" disabled selected hidden>School / Unit</option>
                        <optgroup label="Division Office">
                          <?php get_unit_do(); ?>
                        </optgroup>
                        <optgroup label="Public Schools">
                          <?php get_unit_public(); ?>
                        </optgroup>
                        <optgroup label="Private Schools">
                          <?php get_unit_private(); ?>
                        </optgroup>
                      </select>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-school"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <select class="form-control select2" placeholder="Role" name="role" required>
                        <option value="" disabled selected hidden>Role</option>
                        <option value="1">Administrator</option>
                        <option value="2">Special Access</option>
                        <option value="3">Regular User</option>
                      </select>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-user-shield"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" name="password2" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-12 mb-3">
                      <button type="submit" class="btn btn-success btn-block" name="register"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add User</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
      </div>
    </div>
  </div>
