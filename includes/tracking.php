
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
            <h5 class="text-dark">&nbsp;&nbsp;Tracking number '{$tracking}' not found.</h5>
            <p class="lead text-muted pb-3">&nbsp;&nbsp;Have you typed the correct tracking number?</p>
        </div>
        </div>
CUTIEPIE;
        echo $lovelyella;
        }
        else
        {
        while($row = fetch_array($prettyella))
        {
            $phpdate = strtotime($row['dl_receiveddate']);
            $date = date("F j, Y, g:i a", $phpdate );
            
            if($row['dl_receivedby'] != 0)
            {
            $status = "Received at " . get_unit_name($row['dl_unit']);
            $received = "Received by " . get_owner_name($row['dl_receivedby']) . " - " . $date ;
            }
            else
            {
            $status = "Released to " . get_unit_name($row['dl_unit']);
            $received = "Document not yet received.";
            } 
            $lovelyella = <<<CUTIEPIE
            <div class="d-flex mb-1">
            <div class="d-flex flex-column pr-4 align-items-center">
                <div class="rounded-circle py-2 px-3 bg-secondary text-white mb-1">{$sequence}</div>
                <div class="line h-100"></div>
            </div>
            <div>
                <h5 class="text-dark">&nbsp;&nbsp;{$status}</h5>
                <p class="lead text-muted pb-3">&nbsp;&nbsp;{$received}</p>
            </div>
            </div>
CUTIEPIE;
            $sequence--;
            echo $lovelyella;
        }
        }
    }
    else
    {
    set_message_alert("alert-warning", "fa-exclamation", "No tracking no. entered.");
    redirect($_SERVER['HTTP_REFERER']);
    }
?>
</div>