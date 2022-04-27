<?php
  $tracking = escape_string($_GET['editDoc']);
?>
<div class="content-wrapper wrapper-bgcolor">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Document # <?php echo $tracking; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?tracking=<?php echo $tracking; ?>">Tracking</a></li>
            <li class="breadcrumb-item active">Edit</li>
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
      <div class="col-sm-6 col-12">
        <div class="card">
          <div class="card-header">Document Details</div>
          <div class="card-body bg-white">
            <div class="form-group">
              <label for="Title">Title</label>
              <input type="text" name="title" id="title" class="form-control" value="<?php echo get_document_detail($tracking, 'document_title'); ?>">
            </div>
            <div class="form-group">
              <label for="Title">Current Location</label>
              <input type="text" name="title" id="title" class="form-control" value="<?php echo get_doc_current_location($tracking); ?>">
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
