  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?php display_notice();?>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php get_received_today(); ?></h3>

                <p>Received Documents (Today)</p>
              </div>
              <div class="icon">
                <i class="fas fa-envelope"></i>
              </div>
              <a href="?received" target="_blank" class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php get_released_today(); ?></h3>

                <p>Released documents (Today)</p>
              </div>
              <div class="icon">
                <i class="fas fa-reply"></i>
              </div>
              <a href="?released" target="_blank" class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php get_to_receive_count(); ?></h3>

                <p>To Receive</p>
              </div>
              <div class="icon">
                <i class="fas fa-folder-plus"></i>
              </div>
              <a href="?documents" class="small-box-footer">
                Go to receiving&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php get_accomplished_count(); ?></h3>

                <p>Accomplished</p>
              </div>
              <div class="icon">
                <i class="fas fa-percentage"></i>
              </div>
              <a href="#" target="_blank" class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>


        <div class="row">
            <div class="col">
              <div class="card-header border-warning">
                <h3 class="card-title">All created Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="doctables" class="table table-bordered table-sm table-hover table-responsive-xl">
                  <thead>
                  <tr>
                    <th class="col-2">Tracking #</th>
                    <th class="col-2">Title</th>
                    <th class="col-2">Purpose</th>
                    <th class="col-2">Type</th>
                    <th class="col-2">Date Created</th>
                    <th class="col">Owner</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php echo get_my_docs(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col">
              <div class="card-header border-success">
                <h3 class="card-title">All Accomplished Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="accdoctables" class="table table-bordered table-sm table-hover table-responsive-xl">
                  <thead>
                  <tr>
                    <th class="col-2">Tracking #</th>
                    <th class="col-2">Title</th>
                    <th class="col-2">Purpose</th>
                    <th class="col-2">Type</th>
                    <th class="col-2">Date Created</th>
                    <th class="col">Date Accomplished</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php echo get_accomplished_docs(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
