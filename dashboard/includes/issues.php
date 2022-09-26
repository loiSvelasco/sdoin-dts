<div class="content-wrapper wrapper-bgcolor">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Issue Tracking</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Issue Tracking</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <div class="content">
    <div class="container-fluid">
    <?php display_notice();?>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header border-warning bg-white">
            <h3 class="card-title">All issues</h3>
          </div>
          <div class="card-body bg-white">
            <div class="table-responsive-sm">
              <table id="issuesTable" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                  <tr>
                    <th class="col-2">Status<th>
                    <th class="col-2">Title</th>
                    <th class="col-2">By</th>
                    <th class="col-2">Type</th>
                    <th class="col-2">Date Created</th>
                    <th class="col">Current Location</th>
                  </tr>
                </thead>
                <tbody>
                
                </tbody>
              </table>
            </div>
          </div><!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</div>
