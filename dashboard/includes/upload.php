  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Upload</li>
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
          <div class="col-12 col-lg-3">
            <div class="card">
              <div class="card-header border-danger">
                File Upload
              </div>
              <div class="card-body">
                <form method="post" action="actions/upload.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="fileupload">Allowed file format: .PDF</label>
                    <input type="file" name="file" class="form-control-file" id="fileupload" required>
                    <br>
                    <button type="submit" class="btn btn-success form-control" name="submit"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-9">
            <div class="card-header border-danger">
              Uploaded Documents
            </div>
            <br>
            <table class="table table-bordered table-striped table-hover" id="uploadedDocsTable">
              <thead>
              <tr>
                <th class="text-center col-1">Filename</th>
                <th class="text-center col-2">Title</th>
                <th class="text-center col-7">Released to</th>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
