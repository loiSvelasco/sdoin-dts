<?php
  $tracking = escape_string($_GET['editDoc']);
  if( ! docExists($tracking))
  {
    redirect("./?404");
  }
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
        <div class="card bg-primary">
          <div class="card-header">Edit Document Details</div>
            <div class="card-body bg-white">
              <form action="actions/updateDoc.php" method="POST">
                <div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" name="title" id="title" class="form-control" value="<?php echo get_document_detail($tracking, 'document_title'); ?>">
                </div>
                <div class="form-group">
                  <label for="Description">Description</label>
                  <input type="text" name="desc" id="Description" class="form-control" value="<?php echo get_document_detail($tracking, 'document_desc'); ?>">
                </div>
                <div class="form-group">
                  <label for="Purpose">Purpose</label>
                  <input type="text" name="purpose" id="Purpose" class="form-control" value="<?php echo get_document_detail($tracking, 'document_purpose'); ?>">
                </div>
                <div class="form-group">
                  <label for="Type">Type</label>
                  <select id="doc_type" name="doctype" class="custom-select">
                      <option value="<?php echo get_document_detail($tracking, 'document_type'); ?>" disabled selected hidden><?php echo get_doctype_name(get_document_detail($tracking, 'document_type')); ?></option>
                      <?php get_doctypes(); ?>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-12">
        <div class="card bg-warning">
          <div class="card-header">Edit Document Location</div>
            <div class="card-body bg-white">
              <form action="actions/updateLoc.php" method="post">
                <div class="form-group">
                  <?php if( ! isAccomplished($tracking)): ?>
                    <label for="Title">Current Location</label>
                    <input type="hidden" name="referer" value="<?php echo URI; ?>">
                    <input type="hidden" name="tracking" value="<?php echo $tracking; ?>">
                    <select id="doc_to" name="to" class="custom-select" required>
                        <option value="<?php echo get_doc_current_location($tracking); ?>" selected hidden><?php echo get_unit_name(get_doc_current_location($tracking)); ?></option>
                        <optgroup label="Division Office">
                            <?php get_unit_do(); ?>
                        </optgroup>
                        <optgroup label="Public Schools">
                            <?php get_unit_public(); ?>
                        </optgroup>
                        <optgroup label="Private Schools">
                            <?php get_unit_private(); ?>
                        </optgroup>
                    </select>
                  <?php else: ?>
                    <label for="Title">Current Location: <?php echo get_unit_name(get_doc_current_location($tracking)); ?></label>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <?php if( ! isAccomplished($tracking)): ?>
                    <button type="submit" class="btn btn-warning float-right"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Forward</button>
                  <?php else: ?>
                    <p class="text-sm"><strong>Note:</strong> Document is accomplished, you are unable to change this document's location.</p>
                  <?php endif; ?>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
