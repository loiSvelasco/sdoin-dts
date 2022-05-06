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
        <?php display_notice();?>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php get_received_today_all(); ?></h3>

                <p>Received Documents (Today)</p>
              </div>
              <div class="icon">
                <i class="fas fa-envelope"></i>
              </div>
              <a href="?allReceived"  class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php get_released_today_all(); ?></h3>

                <p>Released Documents (Today)</p>
              </div>
              <div class="icon">
                <i class="fas fa-reply"></i>
              </div>
              <a href="?allReleased"  class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-4">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php getNumUsers() ?></h3>

                <p>Registered Users</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="?users"  class="small-box-footer">
                Manage Users&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-4">
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php getNumDocs() ?></h3>

                <p>Created Documents</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="?allDocs"  class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-4">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php getLapsedNumDocs(); ?></h3>

                <p>Lapsed Documents</p>
              </div>
              <div class="icon">
                <i class="fas fa-times"></i>
              </div>
              <a href="?lapsedDocs"  class="small-box-footer">
                More info&nbsp;&nbsp;&nbsp;<i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- <div class="row"> -->
          <?php //issueNotice(); ?>
        <!-- </div> -->


        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-success bg-white">
                <h3 class="card-title">All Accomplished Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body bg-white">
                <div class="table-responsive-sm">
                  <table id="accdoctables" class="table table-striped table-bordered table-hover table-sm">
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
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
