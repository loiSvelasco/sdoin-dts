  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
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
              <div class="card-header border-danger bg-white">
                File Upload
              </div>
              <div class="card-body bg-white">
                <form method="post" action="actions/upload.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="fileupload">Allowed file format: .PDF</label>
                    <p class="text-muted">Maximum size of 10MB</p>
                    <input type="file" name="file" class="form-control-file" id="fileupload" required>
                  </div>
                  <div class="form-group">
                    <input type="text" name="doc_title" class="form-control" placeholder="Document Title" required>
                  </div>
                  <div class="form-group">
                    <select class="form-control select2" placeholder="School/Unit" name="doc_unit" required>
                      <option value="" disabled selected hidden>Release to:</option>
                        <?php get_unit_heads(); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <textarea id="remarks" name="doc_action" placeholder="Action / Remarks" cols="40" rows="5" class="form-control" required="required"></textarea>
                  </div>
                  <button type="submit" class="btn btn-success form-control" name="submit"><i class="fa fa-upload"></i>&nbsp;&nbsp;Upload</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-9">
            <div class="card">
              <div class="card-header border-danger bg-white">
                Uploaded Documents
              </div>
              <div class="card-body bg-white">
                <table class="table table-bordered table-striped table-hover" id="uploadedDocsTable">
                  <thead>
                  <tr>
                    <th class="text-center col-3">Filename</th>
                    <th class="text-center col-8">Title</th>
                    <!-- <th class="text-center col-1">Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php echo get_uploaded(); ?>
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
