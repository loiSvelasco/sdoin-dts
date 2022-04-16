  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Status of Document with Tracking no. <?php echo escape_string($_GET['tracking']); ?></h1>
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
      <?php display_notice(); ?>
        <div class="row">
          <div class="col-md-6">
            <blockquote class="quote-olive">
              <h5><i class='far fa-calendar'></i>&nbsp;&nbsp;Timeline</h5>
            </blockquote>
            <div class="stepper d-flex flex-column mt-2 ml-2">
            <?php 
              if(isset($_GET['tracking']))
              {
                  $tracking = escape_string($_GET['tracking']);
                  $prettyella = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' ORDER BY dl_id DESC");
                  confirm($prettyella);
                  $sequence = row_count($prettyella);
                  if(row_count($prettyella) == 0)
                  {
                    $found = false;
                    $lovelyella = <<<CUTIEPIE
                    <div class="d-flex mb-1">
                    <div class="d-flex flex-column pr-4 align-items-center">
                        <div class="rounded-circle py-2 px-3 bg-danger text-white mb-1"><i class='fa fa-exclamation'></i></div>
                        <div class="line h-100"></div>
                    </div>
                    <div>
                        <h5 class="text-dark">Tracking number '{$tracking}' not found.</h5>
                        <p class="lead text-muted pb-3">Have you typed the correct tracking number?</p>
                    </div>
                    </div>
CUTIEPIE;
                    echo $lovelyella;
                  }
                  else
                  {
                    $found = true;
                    $accomp = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}' LIMIT 1");
                    confirm($accomp);
                    $row = fetch_assoc($accomp);
                    if($row['document_accomplished'] == 1)
                    {
                      $accomplishedBy = get_user_name($row['accomp_by']);
  
                      $phpdate = strtotime($row['accomp_date']);
                      $date = date("F j, Y, g:i a", $phpdate );

                      $lovelyella = <<<CUTIEPIE
                      <div class="d-flex mb-1">
                      <div class="d-flex flex-column pr-4 align-items-center">
                          <div class="rounded-circle py-2 px-3 bg-success text-white mb-1">&#10003;</div>
                          <div class="line h-100"></div>
                      </div>
                      <div>
                          <h5 class="text-dark">Document accomplished.</h5>
                          <p class="lead text-muted pb-3">Accomplished by {$accomplishedBy} - {$date}</p>
                      </div>
                      </div>
CUTIEPIE;
                      echo $lovelyella;
                    }

                    while($row = fetch_array($prettyella))
                    {
                      $phpdate = strtotime($row['dl_receiveddate']);
                      $date = date("F j, Y, g:i a", $phpdate );
                      
                      if($row['dl_receivedby'] != 0)
                      {
                        $status = "Received at " . get_unit_name($row['dl_unit']);
                        $received = "Received by " . get_user_name($row['dl_receivedby']) . " - " . $date ;
                        $bg = "bg-success";
                      }
                      else
                      {
                        $status = "Released to " . get_unit_name($row['dl_unit']);
                        $received = "Document not yet received.";
                        $bg = "bg-warning";
                      } 
                      $lovelyella = <<<CUTIEPIE
                      <div class="d-flex mb-1">
                      <div class="d-flex flex-column pr-4 align-items-center">
                          <div class="rounded-circle py-2 px-3 {$bg} text-white mb-1">{$sequence}</div>
                          <div class="line h-100"></div>
                      </div>
                      <div>
                          <h5 class="text-dark">{$status}</h5>
                          <p class="lead text-muted pb-3">{$received}</p>
                      </div>
                      </div>
CUTIEPIE;
                      $sequence--;
                      echo $lovelyella;
                    }
                  }
              }
            ?>
            </div>
          </div>


          <div class="col-md-6">
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
          </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
