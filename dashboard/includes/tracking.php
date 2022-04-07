  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Status of Tracking no. <?php echo escape_string($_GET['tracking']); ?></h1>
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
        <div class="row">
          <div class="col-6">
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
                    $lovelyella = <<<CUTIEPIE
                    <div class="d-flex mb-1">
                    <div class="d-flex flex-column pr-4 align-items-center">
                        <div class="rounded-circle py-2 px-3 bg-secondary text-white mb-1">0</div>
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
                    $accomp = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}' LIMIT 1");
                    confirm($accomp);
                    $row = fetch_assoc($accomp);
                    if($row['document_accomplished'] == 1)
                    {
                      $accomplishedBy = get_owner_name($row['accomp_by']);
  
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
                        $received = "Received by " . get_owner_name($row['dl_receivedby']) . " - " . $date ;
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
          <div class="col-5"></div>
        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
