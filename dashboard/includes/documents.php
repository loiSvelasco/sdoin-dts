  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Receiving & Releasing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Receiving & Releasing</li>
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
        <!-- <hr> -->
        <div class="row">
            <div class="col-lg-6">
              <!-- <div class="card"> -->
                <div class="card-header">
                  <h3 class="card-title">Documents to Receive</h3>
                </div>
                <br>
                <!-- /.card-header -->
                <!-- <div class="card-body"> -->
                  <div class="table-responsive-sm">
                  <table class="table table-bordered table-striped table-hover" id="receiveTable">
                    <thead>
                    <tr>
                      <th data-visible="false"></th>
                      <th class="text-center col-3">Tracking</th>
                      <th class="text-center col-7">Title</th>
                      <!-- <th class="text-center">Type</th>
                      <th class="text-center">Owner</th> -->
                      <th class="text-center col-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php echo get_to_receive(); ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              <!-- </div> -->
            </div>

            <div class="col-lg-6">
              <!-- <div class="card"> -->
                <div class="card-header">
                  <h3 class="card-title">Documents to Release</h3>
                </div>
                <br>
                <!-- /.card-header -->
                <!-- <div class="card-body"> -->
                  <div class="table-responsive-sm">
                  <table id="releaseTable" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                      <th data-visible="false"></th>
                      <th class="text-center col-3">Tracking</th>
                      <th class="text-center col-7">Title</th>
                      <!-- <th class="text-center">Type</th>
                      <th class="text-center">Owner</th> -->
                      <th class="text-center col-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php echo get_to_release(); ?>
                    </tbody>
                    <!-- <tfoot>
                    <tr>
                      <th data-visible="false"></th>
                      <th>Tracking</th>
                      <th>Title</th>
                      <th>Type</th>
                      <th>Owner</th>
                      <th>Action</th>
                    </tr>
                    </tfoot> -->
                  </table>
                </div>
                <!-- /.card-body -->
              <!-- </div> -->
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
