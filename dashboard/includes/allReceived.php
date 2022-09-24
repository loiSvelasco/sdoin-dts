  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Received</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="?admin">Administration</a></li>
              <li class="breadcrumb-item active">Received</li>
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

          <div class="col-lg-3">
            <form action="" method="get" id="adminAllRec"></form>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="received_drpicker" value="">
                  <input type="hidden" form="adminAllRec" name="allReceived">
                  <input type="hidden" form="adminAllRec" name="startDate" class="form-control float-right" id="startDate" value="">
                  <input type="hidden" form="adminAllRec" name="endDate" class="form-control float-right" id="endDate" value="">
                  <div class="input-group-append">
                    <button form="adminAllRec" class="btn btn-warning" type="submit"><i class="fa fa-search"></i>&nbsp;&nbsp;Generate</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-header border-warning bg-white">
                  <h3 class="card-title">All Received Documents</h3>
                </div>
  
                <div class="card-body bg-white">
                  <table id="adminAllReceived" class="table table-bordered table-sm table-hover table-responsive-xl">
                    <thead>
                    <tr>
                      <th class="col-2">Tracking #</th>
                      <th class="col-2">Title</th>
                      <th class="col-2">Purpose</th>
                      <th class="col-2">Type</th>
                      <th class="col-2">Date Received</th>
                      <th class="col">Received by</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
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
