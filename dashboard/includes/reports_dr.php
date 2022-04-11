  <?php
  
    $start = escape_string($_GET['start']);
    $end = escape_string($_GET['end']);

  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports <?php echo $start . "<br>" . $end; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
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
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php get_received_dr($start, $end); ?></h3>

                <p>Received Documents</p>
              </div>
              <div class="icon">
                <i class="fas fa-envelope"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php get_released_dr($start, $end); ?></h3>

                <p>Released documents</p>
              </div>
              <div class="icon">
                <i class="fas fa-reply"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php get_to_receive_count(); ?></h3>

                <p>To Receive</p>
              </div>
              <div class="icon">
                <i class="fas fa-folder-plus"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Rate</p>
              </div>
              <div class="icon">
                <i class="fas fa-percentage"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>


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
                </table>
              </div>
              <!-- /.card-body -->
              </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Accomplished Documents</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="accdoctables" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Tracking</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Owner</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php echo get_accomplished_docs(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
