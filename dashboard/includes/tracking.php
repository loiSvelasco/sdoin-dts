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
                  
                  $purged = $row['document_accomplished'] == 3 ? true : false;
                  $accomplished = $row['document_accomplished'] == 1 ? true : false;
                  $docState = $purged ? 'purged' : ($accomplished ? 'accomplished' : '');

                  if($accomplished)
                  {
                    $accomplishedBy = get_user_name($row['accomp_by']);
                    $accomplishedRem = $row['accomp_remarks'] == "" ? "" : "<strong>Remarks: " . escape_string($row['accomp_remarks'] . "</strong>");
                    $phpdate = strtotime($row['accomp_date']);
                    $date = date("F j, Y, g:i a", $phpdate );

                    $lovelyella = <<<CUTIEPIE
                    <div class="d-flex mb-1">
                    <div class="d-flex flex-column pr-4 align-items-center">
                        <div class="rounded-circle py-2 px-3 bg-success text-white mb-1">&#10003;</div>
                        <div class="line h-100"></div>
                    </div>
                    <div>
                        <h5 class="text-dark"><strong>Document accomplished.</strong></h5>
                        <p class="text-muted pb-3">{$date} | Accomplished by {$accomplishedBy}<br>
                        <span class="strong">{$accomplishedRem}</span>
                        </p>
                    </div>
                    </div>
CUTIEPIE;
                    echo $lovelyella;
                  }

                  if($purged)
                  {
                    $accomplishedBy = get_user_name($row['accomp_by']);
                    $phpdate = strtotime($row['accomp_date']);
                    $date = date("F j, Y, g:i a", $phpdate );

                    $lovelyella = <<<CUTIEPIE
                    <div class="d-flex mb-1">
                    <div class="d-flex flex-column pr-4 align-items-center">
                        <div class="rounded-circle py-2 px-3 bg-danger text-white mb-1">&times;</div>
                        <div class="line h-100"></div>
                    </div>
                    <div>
                        <h5 class="text-dark"><strong>Document purged.</strong></h5>
                        <p class="lead text-muted pb-3">Purged at {$date}</p>
                    </div>
                    </div>
CUTIEPIE;
                    echo $lovelyella;
                  }

                  while($row = fetch_array($prettyella))
                  {                      
                    
                    $remarks = $row['dl_relremarks'] == "" ? "" : "<strong>Remarks: {$row['dl_relremarks']}</strong>";
                    $recipient = ($row['dl_for'] == 0) ? get_unit_name($row['dl_unit']) : get_user_name($row['dl_for']);
                    
                    if($row['dl_receivedby'] != 0)
                    {
                      $recDateRow = strtotime($row['dl_receiveddate']);
                      $recDate = date("F j, Y, g:i a", $recDateRow);

                      $relDateRow = strtotime($row['dl_releaseddate']);
                      $relDate = date("F j, Y, g:i a", $relDateRow);
                      
                      $status = "Received at " . get_unit_name($row['dl_unit']);
                      $received = "$recDate | Received by " . get_user_name($row['dl_receivedby']);
                      $released = "$relDate | Released to $recipient";
                      $bg = "bg-success";
                    }
                    else
                    {
                      $relDateRow = strtotime($row['dl_releaseddate']);
                      $relDate = date("F j, Y, g:i a", $relDateRow);

                      $phpdate = strtotime($row['dl_releaseddate']);
                      $date = date("F j, Y, g:i a", $phpdate );
                      $released = "";

                      $status = "Released to $recipient | <small class='text-muted'>$relDate</small>";
                      $received = "Document not yet received.";
                      $bg = "bg-warning";
                    } 
                    $lovelyella = <<<CUTIEPIE
                    <div class="d-flex mb-1">
                    <div class="d-flex flex-column pr-4 align-items-center">
                        <div class="rounded-circle py-2 px-3 {$bg} text-white mb-1 strong">{$sequence}</div>
                        <div class="line h-100"></div>
                    </div>
                    <div>
                        <h5 class="text-dark"><strong>{$status}</strong></h5>
                        <p class="text-muted pb-3">{$received} <br>
                          {$released} <br>
                          <span class="strong">{$remarks}</span>
                        </p>
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
            <div class="row">
              <div class="col-md-6">
                <blockquote class="quote-info">
                  <h5><i class='far fa-list-alt'></i>&nbsp;&nbsp;Document Details</h5>
                </blockquote>
              </div>
              <div class="col-md-6">
                <div class="row align-items-center">
                  <div class="col-6">
                    <blockquote class="quote-info border-left-0">
                      <?php if($found): ?>
                      <a href="?print=<?= $tracking ?>" class="btn btn-success btn-lg btn-block shadow rounded-0" target="_blank">
                        <i class="fas fa-print"></i>&nbsp;&nbsp;Print eDTS #
                      </a>
                      <?php endif ?>
                    </blockquote>
                  </div>
                  <div class="col-6">
                  <?=
                  '<img src="data:image/png;base64,'
                   . base64_encode($generatorIMG->getBarcode($tracking, $generatorIMG::TYPE_CODE_128, 1, 20))
                   . '">';
                  ?>
                  </div>
                </div>
              </div>
            </div>

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
            <!-- ADMIN CONTROLS -->
            <?php if ($found): ?>
              <?php if ($_SESSION['role'] <= 2): ?>
                <blockquote class="quote-info">
                  <h5><i class='fa fa-user-shield'></i>&nbsp;&nbsp;Admin Controls</h5>
                </blockquote>
                <div class="card shadow-none rounded-0">
                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6">
                      <?php if ($purged || $accomplished): ?>
                        <span data-toggle="tooltip" data-placement="top" title="Cannot edit when document is <?php echo $docState ?>">
                          <a class="btn btn-block btn-primary rounded-0 disabled"><i class="fa fa-pen"></i>&nbsp;&nbsp;Edit</a>
                        </span>
                      <?php else: ?>
                        <a href="?editDoc=<?php echo $tracking; ?>" class="btn btn-block rounded-0 btn-primary"><i class="fa fa-pen"></i>&nbsp;&nbsp;Edit</a>
                      <?php endif; ?>
                      </div>
                      <?php if ($_SESSION['role'] == 1): ?>
                        <div class="col-md-6">
                          <!-- <a href="?purgeDoc=<?php echo $tracking; ?>" class="btn btn-block btn-danger"><i class="fa fa-fire"></i>&nbsp;&nbsp;Purge</a> -->
                          <?php if ($purged || $accomplished): ?>
                          <span data-toggle="tooltip" data-placement="top" title="Cannot purge when document is <?php echo $docState ?>">
                            <a class="btn btn-block btn-danger rounded-0 disabled"><i class="fa fa-fire"></i>&nbsp;&nbsp;Purge</a>
                          </span>
                          <?php else: ?>
                            <a href="#" class="btn btn-block btn-danger rounded-0" 
                            data-href="?manipulate=purge&tracking=<?php echo $tracking ?>
                            &unit=<?php echo $_SESSION['unit'] ?>
                            &by=<?php echo $_SESSION['user_id'] ?>
                            &refer=<?php echo $_SERVER['REQUEST_URI'] ?>" 
                            data-toggle="modal" data-target="#purge-doc">
                            <i class="fa fa-fire"></i>&nbsp;&nbsp;Purge</a>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
            <!-- /ADMIN CONTROLS -->
          </div>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
