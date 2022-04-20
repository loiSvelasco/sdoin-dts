
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

            <div class="col-12">
              <div class="card-header border-warning bg-white">
                <h3 class="card-title">Manage Users</h3>
              </div>

              <div class="card-body bg-white">
                <table id="reportTable" class="table table-bordered table-sm table-hover table-responsive-xl">
                  <thead>
                  <tr>
                    <th class="col-1">#</th>
                    <th class="col-2">Email</th>
                    <th class="col-2">Full Name</th>
                    <th class="col-2">Role</th>
                    <th class="col-2">Unit</th>
                    <th class="col">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    allUsers();
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

      </div>
    </div>
  </div>
