<div class="content-wrapper wrapper-bgcolor">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Documents of <?= $user ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Documents of <?= $user ?></li>
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
        <div class="card-body bg-white">
          <table id="reportTable" class="table table-bordered table-sm table-hover table-responsive-xl">
            <thead>
            <tr>
              <th class="col-2">Tracking #</th>
              <th class="col-2">Title</th>
              <th class="col-2">Purpose</th>
              <th class="col-2">Type</th>
              <th class="col-2">Date Created</th>
              <th class="col">Status</th>
              <th class="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
              allDocsBy($userID);
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
