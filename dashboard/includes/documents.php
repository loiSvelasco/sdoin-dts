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
                <div class="card-header border-warning">
                  <h3 class="card-title">
                  <button type="submit" form="receive" class="btn btn-warning btn-sm btn-flat" name="rec-selected">Receive Selected</button>
                  &nbsp;&nbsp;&nbsp;Documents to Receive</h3>
                </div>
                <br>
                  <div class="table-responsive-sm">
                    <table class="table table-bordered table-striped table-hover" id="receiveTable">
                      <thead>
                      <tr>
                        <th class="text-center col-1"><form action="actions/multi-receive.php" id="receive" method="post">
                        <input type="checkbox" id="select-all-rec" data-toggle="tooltip" data-placement="left" title="Select All">&nbsp;&nbsp;</form></th>
                        <th class="text-center col-2">Tracking</th>
                        </form>
                        <th class="text-center col-7">Title</th>
                        <!-- <th class="text-center">Type</th>
                        <th class="text-center">Owner</th> -->
                        <th class="text-center col-1">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php echo get_to_receive(); ?>
                      </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card-header border-info">
                  <h3 class="card-title">
                  <button type="button" class="btn btn-sm btn-flat btn-info" data-toggle="modal" data-target="#modal-release-multi-doc" form="release" name="rel-selected">Release Selected</button>
                  &nbsp;&nbsp;&nbsp;Documents to Release</h3>
                </div>
                <br>
                  <div class="table-responsive-sm">
                    <table id="releaseTable" class="table table-striped table-bordered table-hover">
                      <thead>
                      <tr>
                        <th class="text-center col-1"><form action="actions/multi-release.php" id="release" method="post">
                            <input type="checkbox" id="select-all-rel" data-toggle="tooltip" data-placement="left" title="Select All">&nbsp;&nbsp;</form></th>
                        <th class="text-center col-2">Tracking</th>
                        <th class="text-center col-7">Title</th>
                        <!-- <th class="text-center">Type</th>
                        <th class="text-center">Owner</th> -->
                        <th class="text-center col-1">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php echo get_to_release(); ?>
                      </tbody>
                    </table>
                </div>
            </div>

            
        </div>
        <br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
