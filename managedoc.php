<?php

function release($tracking, $unit, $to)
{
    $ellaganda = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' AND dl_unit = '{$unit}' ORDER BY dl_id DESC LIMIT 1");
    confirm($ellaganda);

    if(row_count($ellaganda) >= 1)
    {
        $receive = query("UPDATE docs_location SET dl_forwarded = 1 WHERE dl_tracking = '{$tracking}' AND dl_unit = '{$unit}'");
        confirm($receive);
    }

    $query = "INSERT INTO docs_location(dl_tracking, dl_unit) "; 
    $query .= "VALUES('{$tracking}', '{$to}')";
    $insert = query($query);
    confirm($insert);
}

function receive($tracking, $unit, $by)
{
    $ellaganda = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' AND dl_unit = '{$unit}' ORDER BY dl_id DESC LIMIT 1");
    confirm($ellaganda);

    if(row_count($ellaganda) >= 1)
    {
        $date = date('Y-m-d H:i:s');
        $receive = query("UPDATE docs_location SET dl_receivedby = '{$by}', dl_receiveddate = '{$date}' WHERE dl_tracking = '{$tracking}' ");
        confirm($receive);
    }
    else
    {
        // throw error
    }

}

?>