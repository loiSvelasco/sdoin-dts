<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Receiving & Releasing <span class="text-muted small"> | Legacy</span></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Receiving & Releasing</li>
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
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-6">Tracking #:</h1>
            <!-- <input type="search" name="tracking-no" id="tracking-no" class="form-control"> -->
            <form method="GET">
              <div class="input-group">
                <input type="search" aria-label="Search" name="legacy" id="legacy" class="form-control form-control-lg rounded-0" autofocus required>
                <div class="input-group-append">
                  <button class="btn btn-warning rounded-0" type="submit">
                    <i class="fas fa-search"></i>&nbsp;&nbsp;Track
                  </button>
                </div>
              </div>
            </form>
            <p class="lead">Legacy mode handles 1 document at a time, this is suitable for users with slow internet / underpowered computers.</p>
          </div>
        </div>
      </div><!-- /col -->
    </div><!-- /row -->
    <div class="row">
      <div class="col-12">
        <section class="border-bottom" id="features">
              <div class="container px-5">
                  <div class="row gx-5">
                    <?php 
                      if($_GET['legacy'] != '') {
                        $tracking = escape_string($_GET['legacy']);
                        $found = docExists($tracking);
                    ?>
                    <blockquote class="quote-info">
                      <h5><i class='far fa-list-alt'></i>&nbsp;&nbsp;Document Details</h5>
                    </blockquote>
                    <div class="card shadow-none rounded-0">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="info-box shadow-none">
                              <span class="info-box-icon"><i class="far fa-edit"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Document Title</span>
                                <span class="info-box-text text-wrap"><strong><?php echo $found ? get_document_detail($tracking, 'document_title') : "<span class='text-danger'><i class='fa fa-exclamation'></i>&nbsp;&nbsp;Tracking # not found.</span>"; ?></strong></span>
                                <span class="info-box-text"><?php echo $found ? get_doctype_name(get_document_detail($tracking, 'document_type')) : ""; ?></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="info-box shadow-none">
                              <span class="info-box-icon"><i class="far fa-clock"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Date Created</span>
                                <span class="info-box-text text-wrap"><strong><?php echo $found ? format_date(get_document_detail($tracking, 'date_created')) : "<span class='text-danger'><i class='fa fa-exclamation'></i>&nbsp;&nbsp;Tracking # not found.</span>"; ?></strong></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="info-box shadow-none">
                              <span class="info-box-icon"><i class="far fa-user"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Document Owner</span>
                                <span class="info-box-text text-wrap"><strong><?php echo $found ? get_user_name(get_document_detail($tracking, 'document_owner')) : "<span class='text-danger'><i class='fa fa-exclamation'></i>&nbsp;&nbsp;Tracking # not found.</span>"; ?></strong></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="info-box shadow-none">
                              <span class="info-box-icon"><i class="far fa-building"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Originating Office</span>
                                <span class="info-box-text text-wrap"><strong><?php echo $found ? get_unit_name(get_document_detail($tracking, 'document_origin')) : "<span class='text-danger'><i class='fa fa-exclamation'></i>&nbsp;&nbsp;Tracking # not found.</span>"; ?></strong></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="info-box shadow-none">
                              <span class="info-box-icon"><i class="far fa-sticky-note"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Document Description</span>
                                <span class="info-box-text text-wrap"><strong><?php echo $found ? get_document_detail($tracking, 'document_desc') : "<span class='text-danger'><i class='fa fa-exclamation'></i>&nbsp;&nbsp;Tracking # not found.</span>"; ?></strong></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="info-box shadow-none">
                              <span class="info-box-icon"><i class="far fa-star"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">Document Purpose</span>
                                <span class="info-box-text text-wrap"><strong><?php echo $found ? get_document_detail($tracking, 'document_purpose') : "<span class='text-danger'><i class='fa fa-exclamation'></i>&nbsp;&nbsp;Tracking # not found.</span>"; ?></strong></span>
                              </div>
                            </div>
                          </div>
                        </div> <!-- /ROW -->
                      </div>
                    </div>
                    <?php } else { ?>
                      <p class="lead">Search for a tracking no. to see its document details.</p>
                    <?php } ?>
                  </div>
              </div>
          </section>
      </div>
    </div>
  </div>
</div>
