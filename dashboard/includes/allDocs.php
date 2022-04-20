  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Documents</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="?admin">Administration</a></li>
              <li class="breadcrumb-item active">All Documents</li>
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
            <div class="col-12">
              <div class="card-header border-warning bg-white">
                <h3 class="card-title">All Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body bg-white">
                <div class="table-responsive-sm">
                  <table id="doctables" class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                      <tr>
                        <th class="col-2">Tracking #</th>
                        <th class="col-2">Title</th>
                        <th class="col-2">Purpose</th>
                        <th class="col-2">Type</th>
                        <th class="col-2">Date Created</th>
                        <th class="col">Owner</th>
                        <th class="col-2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php echo allDocs(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
