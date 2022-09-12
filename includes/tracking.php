
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
            <h5 class="text-dark">&nbsp;&nbsp;&nbsp;Tracking number '{$tracking}' not found.</h5>
            <p class="lead text-muted pb-3">&nbsp;&nbsp;&nbsp;Have you typed the correct tracking number?</p>
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
              <h5 class="text-dark">&nbsp;&nbsp;&nbsp;<strong>Document accomplished.</strong></h5>
              <p class="text-muted pb-3">&nbsp;&nbsp;&nbsp;{$date} | Accomplished by {$accomplishedBy}<br>
              <span class="strong">&nbsp;&nbsp;&nbsp;{$accomplishedRem}</span>
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
              <h5 class="text-dark"><strong>&nbsp;&nbsp;&nbsp;Document purged.</strong></h5>
              <p class="lead text-muted pb-3">&nbsp;&nbsp;&nbsp;Purged at {$date}</p>
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
              <h5 class="text-dark">&nbsp;&nbsp;&nbsp;<strong>{$status}</strong></h5>
              <p class="text-muted pb-3">&nbsp;&nbsp;&nbsp;{$received} <br>
              &nbsp;&nbsp;&nbsp;{$released} <br>
                <span class="strong">&nbsp;&nbsp;&nbsp;{$remarks}</span>
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