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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">All created Documents</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="doctables" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th data-visible="false">ID</th>
                  <th>Tracking</th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Owner</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php echo get_my_docs(); ?>
                </tbody>
                <tfoot>
                <tr>
                  <th data-visible="false">ID</th>
                  <th>Tracking</th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Owner</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
