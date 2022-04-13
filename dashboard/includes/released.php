  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Released</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item"><a href="?reports">Reports</a></li>
              <li class="breadcrumb-item active">Released</li>
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
          <div class="col-3">
            <form action="" method="get" id="daterange"></form>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="received_drpicker" value="">
                  <input type="hidden" form="daterange" name="released">
                  <input type="hidden" form="daterange" name="startDate" class="form-control float-right" id="startDate" value="">
                  <input type="hidden" form="daterange" name="endDate" class="form-control float-right" id="endDate" value="">
                  <div class="input-group-append">
                    <button form="daterange" class="btn btn-outline-info" type="submit"><i class="fa fa-search"></i>&nbsp;&nbsp;Generate</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card-header border-info">
                <h3 class="card-title">All Released Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="reportTable" class="table table-bordered table-sm table-hover table-responsive-xl">
                  <thead>
                  <tr>
                    <th class="col-2">Tracking #</th>
                    <th class="col-2">Title</th>
                    <th class="col-2">Purpose</th>
                    <th class="col-2">Type</th>
                    <th class="col-2">Date Created</th>
                    <th class="col">Released by</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    isset($_GET['startDate']) ? $start = escape_string($_GET['startDate']) : $start = 0;
                    isset($_GET['endDate']) ? $end = escape_string($_GET['endDate']) : $end = 0;
                    isset($_GET['startDate']) && isset($_GET['endDate']) ? $today = false : $today = true;
                    echo released_details($today, $start, $end); 
                  ?>
                  </tbody>
                </table>
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
