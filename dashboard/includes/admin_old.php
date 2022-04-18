  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Administration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?php display_notice(); ?>
        <div class="row">
          
          <!-- <div class="col-lg-3 col-6">
            <div class="info-box bg-info">
              <span class="info-box-icon"><a href="#" target="_blank" class="text-white"><i class="far fa-user"></i></a></span>
              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-text"><strong><?php // getNumUsers(); ?></strong></span>
              </div>
            </div>
          </div> -->

          <div class="col-lg-3 col-6">
            <a href="#" class="btn btn-outline-info btn-lg btn-block"><i class="far fa-user"></i>&nbsp;&nbsp;&nbsp;Manage Users</a>
          </div>

          <div class="col-lg-3 col-6">
            <a href="#" class="btn btn-outline-warning btn-lg btn-block"><i class="far fa-file"></i>&nbsp;&nbsp;&nbsp;Manage Documents</a>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
