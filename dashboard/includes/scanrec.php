  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper wrapper-bgcolor">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Scan to Receive</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Tracking</li>
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
      <div class="input-group mb-3">
        <form action="actions/scanrec.php" method="POST" id="scanrec"></form>
        <input type="text" name="tracking" form="scanrec" class="form-control" placeholder="Tracking No." autofocus required>
        <div class="input-group-append">
          <button class="btn btn-warning" type="submit" name="scanrec" form="scanrec">Receive</button>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card rounded-0">
          <div class="card-header border-info bg-white">
            <h3 class="card-title">
            <form action="actions/multi-release.php?refer=<?php echo $_SERVER['REQUEST_URI']; ?>" id="release" method="post" onsubmit="relDocMultiBtn.hidden = true; document.getElementById('relDocMultiBtn2').style.display = '';"></form>
            <button type="button" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modal-release-multi-doc" form="release" name="rel-selected">
            <i class="fa fa-file-export"></i>&nbsp;&nbsp;&nbsp;
            Release Selected</button>
            &nbsp;&nbsp;&nbsp;Documents to Release</h3>
          </div>
          <div class="card-body bg-white">
            <div class="table-responsive-sm">
                <table id="releaseTable" class="table table-striped table-bordered table-hover">
                  <thead>
                  <tr>
                    <th class="text-center col-1">
                      <input type="checkbox" id="select-all-rel" data-toggle="tooltip" data-placement="left" title="Select All">
                    </th>
                    <th class="text-center col-2">Tracking</th>
                    <th class="text-center col-2">for</th>
                    <th class="text-center col-7">Title</th>
                    <th class="text-center col">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <!-- <?php //echo get_to_release(); ?> -->
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
