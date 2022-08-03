  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Uploaded files shared with you</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Uploaded</li>
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
          <div class="col-12 col-lg-12">
            <div class="card">
              <div class="card-header border-danger bg-white">
                Uploaded Documents
              </div>
              <div class="card-body bg-white">
                <table class="table table-bordered table-striped table-hover" id="uploadedDocsTable">
                  <thead>
                  <tr>
                    <th class="text-center col-2">Filename</th>
                    <th class="text-center col-8">Title</th>
                    <th class="text-center col-2">Date Uploaded</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php echo get_uploaded_shared(); ?>
                  </tbody>
                </table>
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
