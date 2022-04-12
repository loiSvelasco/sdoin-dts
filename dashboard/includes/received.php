  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
              <li class="breadcrumb-item"><a href="?reports">Reports</a></li>
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
            <div class="col-12">
              <div class="card-header border-warning">
                <h3 class="card-title">All Received Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="reportTable" class="table table-bordered table-sm table-hover table-responsive-xl">
                  <thead>
                  <tr>
                    <th class="col-1">Tracking</th>
                    <th class="col-3">Title</th>
                    <th class="col-2">Purpose</th>
                    <th class="col-2">Type</th>
                    <th class="col-1">Date Created</th>
                    <th class="col-1">Received by</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    isset($_GET['start']) ? $start = escape_string($_GET['start']) : $start = 0;
                    isset($_GET['end']) ? $end = escape_string($_GET['end']) : $end = 0;
                    isset($_GET['start']) && isset($_GET['end']) ? $today = false : $today = true;
                    echo received_today_details($today, $start, $end); 
                    echo $start;
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
