<?php

/*
 *
 *  HELPER FUNCTIONS
 *  Author: Louis Velasco
 *  Used for Procedural PHP
 *
 */
function currentdate()
{
    return date('Y-m-d');
}

function last_id()
{
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message_text($type, $icon, $message)
{
    $structure = <<<LOIPOGI
    <span class="{$type}"><i class="fa fa-w {$icon}"></i>&nbsp;&nbsp;{$message}</span>
LOIPOGI;

    $_SESSION['notice'] = $structure;
}

function set_message_alert($type, $icon, $message)
{
    $structure = <<<LOIPOGI
    <div class="alert {$type}" role="alert"><i class="fa fa-w {$icon}" role="alert"></i>&nbsp;&nbsp;{$message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
LOIPOGI;

    $_SESSION['notice'] = $structure;
}

function display_notice()
{
    if(isset($_SESSION['notice']))
    {
        echo $_SESSION['notice'];
        unset($_SESSION['notice']);
    }
}

function redirect($location)
{
    header("Location: $location");
}

function refresh($interval, $location)
{
    header("Refresh: {$interval}; URL={$location}");
}

function confirm($result)
{
    global $connection;

    if(!$result)
    {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function love($result)
{
    global $connection;

    if(!$result)
    {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function query($sql)
{
    global $connection;
    global $numQueries;
    $numQueries++;
    return mysqli_query($connection, $sql);
}

function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

function fetch_assoc($result)
{
    return mysqli_fetch_assoc($result);
}

function row_count($query)
{
    return mysqli_num_rows($query);
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function random_num($length, $keyspace = '0123456789')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function format_date($date)
{
    return date("F j, Y - g:i a", strtotime($date));
}

function shortNumber($num) 
{
    $units = ['', 'K', 'M', 'B', 'T'];
    for ($i = 0; $num >= 1000; $i++) {
        $num /= 1000;
    }
    return round($num, 1) . $units[$i];
}

/*
 *
 *  FRONT END FUNCTIONS
 *
 */

function get_unit_do()
{
    $sql = query(
        "SELECT * FROM units 
         WHERE unit_type = 'Division Office'"
    );
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);

        $option = <<<ELLA
        <option value="{$unit_id}">{$unit_name}</option>
ELLA;
        echo $option;
    }
}

function current_unit()
{
    return get_unit_name($_SESSION['unit']);
}

function get_personnel_from_unit()
{
    $sql = query(
        "SELECT DISTINCT users.id AS u_id, 
         user_details.id AS ud_id, 
         locked, ud_name, ud_unit 
         FROM user_details, users 
         WHERE locked = 0 
         AND users.id = user_details.id 
         AND ud_unit = {$_SESSION['unit']}"
    );
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $id = $row['u_id'];
        $name = $row['ud_name'];

        $option = <<<ELLA
        <option value="{$id}">{$name}</option>    
ELLA;
        echo $option;
    }
}

function get_unit_heads()
{
    $sql = query(
        "SELECT * FROM units 
         WHERE unit_type = 'Division Office' 
         AND unit_head = 1 
         AND unit_id != {$_SESSION['unit']}"
    );
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);

        $option = <<<ELLA
        <option value="{$unit_id}">{$unit_name}</option>
ELLA;
        echo $option;
    }
}

function get_unit_public()
{
    $sql = query("SELECT * FROM units WHERE unit_type = 'School' AND unit_sector = 'Public'");
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);
        $strArr = explode(" - ", $unit_name);
        $school = $strArr[1] . " - " . $strArr[0];

        $cutie = <<<ELLA
        <option value="{$unit_id}">{$school}</option>
ELLA;
        echo $cutie;
    }
}

function get_unit_integ()
{
    $sql = query(
        "SELECT * FROM units 
         WHERE unit_type = 'School' 
         AND unit_sector = 'Public' 
         AND unit_id >= 500000"
    );
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);
        $strArr = explode(" - ", $unit_name);
        $school = $strArr[1] . " - " . $strArr[0];

        $cutie = <<<ELLA
        <option value="{$unit_id}">{$school}</option>
ELLA;
        echo $cutie;
    }
}

function get_unit_elem()
{
    $sql = query(
        "SELECT * FROM units 
         WHERE unit_type = 'School' 
         AND unit_sector = 'Public' 
         AND unit_id < 300000"
    );
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);
        $strArr = explode(" - ", $unit_name);
        $school = $strArr[1] . " - " . $strArr[0];

        $cutie = <<<ELLA
        <option value="{$unit_id}">{$school}</option>
ELLA;
        echo $cutie;
    }
}

function get_unit_sec()
{
    $sql = query(
        "SELECT * FROM units 
         WHERE unit_type = 'School' 
         AND unit_sector = 'Public' 
         AND unit_id >= 300000 
         AND unit_id < 500000"
    );
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);
        $strArr = explode(" - ", $unit_name);
        $school = $strArr[1] . " - " . $strArr[0];

        $cutie = <<<ELLA
        <option value="{$unit_id}">{$school}</option>
ELLA;
        echo $cutie;
    }
}

function get_unit_private()
{
    $sql = query("SELECT * FROM units WHERE unit_type = 'School' AND unit_sector = 'Private'");
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $unit_id = escape_string($row['unit_id']);
        $unit_name = escape_string($row['unit_name']);
        $strArr = explode(" - ", $unit_name);
        $school = $strArr[1] . " - " . $strArr[0];

        $cutie = <<<ELLA
        <option value="{$unit_id}">{$school}</option>
ELLA;
        echo $cutie;
    }
}

function get_unit_name($unit_id)
{
    $sql = query("SELECT * FROM units WHERE unit_id = {$unit_id}");
    confirm($sql);

    $row = fetch_assoc($sql);
    return $row['unit_name'];
}

function get_doctypes()
{
    $sql = query("SELECT * FROM doctypes");
    confirm($sql);

    while($row = fetch_array($sql))
    {
        $doc_id = escape_string($row['doc_id']);
        $doc_type = escape_string($row['doc_type']);

        $option = <<<ELLA
        <option value="{$doc_id}">{$doc_type}</option>
ELLA;
        echo $option;
    }
}

function get_doctype_name($id)
{
    $printetella = query("SELECT * FROM doctypes WHERE doc_id = {$id}");
    confirm($printetella);
    
    $row = fetch_assoc($printetella);
    return $row['doc_type'];
}

function get_document_detail($tracking, $index)
{
    $printetella = query("SELECT * FROM documents WHERE document_tracking = '{$tracking}'");
    confirm($printetella);
    
    $row = fetch_assoc($printetella);
    return $row[$index];
}

function get_user_name($id)
{
    $printetella = query("SELECT * FROM user_details WHERE id = {$id}");
    confirm($printetella);
    
    $row = fetch_assoc($printetella);
    return $row['ud_name'];
}

function get_my_docs()
{
    $ella = query("SELECT * FROM documents WHERE document_origin = {$_SESSION['unit']} AND document_accomplished = 0 ORDER BY id DESC LIMIT " . DOC_QUERY_LIMIT);
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $doctype = get_doctype_name($row['document_type']);
        // $origin = get_unit_name($row['document_origin']);
        // $owner = get_user_name($row['document_owner']);
        $title = $row['document_title'];
        $purpose = $row['document_purpose'];
        $tracking = $row['document_tracking'];
        $date = format_date($row['date_created']);

        $currentLocation = get_doc_current_location($tracking);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle">
            <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
            <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                {$tracking}
            </td>
            <td class="align-middle">{$title}</td>
            <td class="align-middle">{$purpose}</td>
            <td class="align-middle">{$doctype}</td>
            <td class="align-middle">{$date}</td>
            <td class="align-middle">{$currentLocation}</td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function get_doc_current_location($tracking)
{
    $superduperultramegacutiepieprintetella = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' ORDER BY dl_id DESC LIMIT 1");
    confirm($superduperultramegacutiepieprintetella);

    if(row_count($superduperultramegacutiepieprintetella) >= 1)
    {
        $row = fetch_assoc($superduperultramegacutiepieprintetella);
        $received = ($row['dl_receivedby'] == 0) ? ", not yet received." : "";
        return get_unit_name($row['dl_unit']) . $received;
    }
    else
    {
        return null;
    }
}

function get_doc_current_location_edit($tracking)
{
    $locQuery = query("SELECT * FROM docs_location WHERE dl_tracking = '{$tracking}' ORDER BY dl_id DESC LIMIT 1");
    confirm($locQuery);

    if(row_count($locQuery) >= 1)
    {
        $row = fetch_assoc($locQuery);
        return $row['dl_unit'];
    }
    else
    {
        return null;
    }
}

function get_to_receive()
{
    $ella = query("SELECT * FROM docs_location WHERE dl_unit = {$_SESSION['unit']} AND dl_receivedby = 0 ORDER BY dl_id ASC");
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $for = $row['dl_for'];

        if($for == $_SESSION['user_id'])
        {
            $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
            confirm($bbyella);
            while($docRow = fetch_array($bbyella))
            {
                $doctype = get_doctype_name($docRow['document_type']);
                $origin = get_unit_name($docRow['document_origin']);
                $owner = get_user_name($docRow['document_owner']);
                $title = $docRow['document_title'];
                $desc = $docRow['document_desc'];
                $purpose = $docRow['document_purpose'];
                $tracking = $docRow['document_tracking'];
                $date = format_date($docRow['date_created']);
        
                $ellacutie = <<<ELLA
                <tr>
                    <td class="text-center align-middle"><input type="checkbox" name="rec-check[]" value="{$tracking}" class="receiveBox" form="receive">&nbsp;&nbsp;</td>
                    <td class="text-center align-middle">{$tracking}</td>
                    <td><a tabindex="0" class="btn btn-link btn-sm text-left rounded-0 popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                        data-content="
                        Type: {$doctype}
                        <br>Origin: {$origin}
                        <br>Owner: {$owner}
                        <br>Purpose: {$purpose}
                        <br>Description: {$desc}
                        <hr>Date Created:<br>{$date}">
                        <small><span class="badge badge-pill badge-danger">&ensp;</span></small>&nbsp;
                        {$title}<strong class="small text-muted"> | {$doctype}</strong></td></a>
                    <td class="text-center">
                        <a href="?manipulate=receive&tracking={$tracking}&refer={$_SERVER['REQUEST_URI']}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Receive"><i class="fa fa-file-import"></i></a>
                    </td>
                </tr>
ELLA;
                echo $ellacutie;
            }
        }
        else if($for == 0)
        {
            $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
            confirm($bbyella);
            while($docRow = fetch_array($bbyella))
            {
                $doctype = get_doctype_name($docRow['document_type']);
                $origin = get_unit_name($docRow['document_origin']);
                $owner = get_user_name($docRow['document_owner']);
                $title = $docRow['document_title'];
                $desc = $docRow['document_desc'];
                $purpose = $docRow['document_purpose'];
                $tracking = $docRow['document_tracking'];
                $date = format_date($docRow['date_created']);
        
                $ellacutie = <<<ELLA
                <tr>
                    <td class="text-center align-middle"><input type="checkbox" name="rec-check[]" value="{$tracking}" class="receiveBox" form="receive">&nbsp;&nbsp;</td>
                    <td class="text-center align-middle">{$tracking}</td>
                    <td><a tabindex="0" class="btn btn-link btn-sm text-left rounded-0 popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                        data-content="
                        Type: {$doctype}
                        <br>Origin: {$origin}
                        <br>Owner: {$owner}
                        <br>Purpose: {$purpose}
                        <br>Description: {$desc}
                        <hr>Date Created:<br>{$date}">
                        {$title}<strong class="small text-muted"> | {$doctype}</strong></td></a>
                    <td class="text-center">
                        <a href="?manipulate=receive&tracking={$tracking}&refer={$_SERVER['REQUEST_URI']}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Receive"><i class="fa fa-file-import"></i></a>
                    </td>
                </tr>
ELLA;
                echo $ellacutie;
            }
        }
    }
}

function get_to_receive_count()
{
    $ella = query("SELECT * FROM docs_location WHERE dl_unit = {$_SESSION['unit']} AND dl_receivedby = 0 ORDER BY dl_id ASC");
    confirm($ella);
    $counter = 0;
    while($row = fetch_array($ella))
    {
        $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
        confirm($bbyella);

        $counter++;
    }
    echo $counter;
}

function get_to_release()
{
    $ella = query("SELECT DISTINCT dl_tracking, dl_id, dl_for FROM docs_location WHERE dl_unit = {$_SESSION['unit']} AND dl_receivedby != 0 AND dl_forwarded = 0 ORDER BY dl_id DESC");
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $for = $row['dl_for'];

        if($for == $_SESSION['user_id'])
        {
            $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
            confirm($bbyella);
            while($docRow = fetch_array($bbyella))
            {
                $doctype = get_doctype_name($docRow['document_type']);
                $origin = get_unit_name($docRow['document_origin']);
                $owner = get_user_name($docRow['document_owner']);
                $title = $docRow['document_title'];
                $desc = $docRow['document_desc'];
                $purpose = $docRow['document_purpose'];
                $tracking = $docRow['document_tracking'];

                $date = format_date($docRow['date_created']);
        
                $ellacutie = <<<ELLA
                <tr>
                    <td class="text-center align-middle"><input type="checkbox" name="rel-check[]" form="release" class="releaseBox" value="{$tracking}">&nbsp;&nbsp;</td>
                    <td class="text-center align-middle">{$tracking}</td>
                    <td class="align-middle"><a tabindex="0" class="btn btn-sm btn-link rounded-0 text-left popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                    data-content="
                    Type: {$doctype}
                    <br>Origin: {$origin}
                    <br>Owner: {$owner}
                    <br>Purpose: {$purpose}
                    <br>Description: {$desc}
                    <hr>Date Created: <br>{$date}">
                    <small><span class="badge badge-pill badge-danger">&ensp;</span></small>&nbsp;
                    {$title}<strong class="small text-muted"> | {$doctype}</strong></a></td>
                    <td class="text-center">
                        <span data-toggle="tooltip" data-placement="left" title="Release"><button data-toggle="modal" data-target="#modal-release-doc" class="btn btn-sm btn-info release_doc mb-1"><i class="fa fa-file-export white"></i></button></span>
                        <span data-toggle="tooltip" data-placement="right" title="Mark as accomplished">
                            <a href="#" class="btn btn-sm btn-success mb-1"
                            data-tracking="{$tracking}"
                            data-refer="{$_SERVER['REQUEST_URI']}"
                            data-manipulate="accomplish"
                            data-toggle="modal" 
                            data-target="#complete-doc"><i class="fa fa-check"></i></a>
                        </span>
                    </td>
                </tr>
ELLA;
                echo $ellacutie;
            }
        }
        else if ($for == 0)
        {
            $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
            confirm($bbyella);
            while($docRow = fetch_array($bbyella))
            {
                $doctype = get_doctype_name($docRow['document_type']);
                $origin = get_unit_name($docRow['document_origin']);
                $owner = get_user_name($docRow['document_owner']);
                $title = $docRow['document_title'];
                $desc = $docRow['document_desc'];
                $purpose = $docRow['document_purpose'];
                $tracking = $docRow['document_tracking'];

                $date = format_date($docRow['date_created']);
        
                $ellacutie = <<<ELLA
                <tr>
                    <td class="text-center align-middle"><input type="checkbox" name="rel-check[]" form="release" class="releaseBox" value="{$tracking}">&nbsp;&nbsp;</td>
                    <td class="text-center align-middle">{$tracking}</td>
                    <td class="align-middle"><a tabindex="0" class="btn btn-sm btn-link rounded-0 text-left popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                    data-content="
                    Type: {$doctype}
                    <br>Origin: {$origin}
                    <br>Owner: {$owner}
                    <br>Purpose: {$purpose}
                    <br>Description: {$desc}
                    <hr>Date Created: <br>{$date}
                    ">{$title}<strong class="small text-muted"> | {$doctype}</strong></a></td>
                    <td class="text-center">
                        <span data-toggle="tooltip" data-placement="left" title="Release"><button data-toggle="modal" data-target="#modal-release-doc" class="btn btn-sm btn-info release_doc mb-1"><i class="fa fa-file-export white"></i></button></span>
                        <span data-toggle="tooltip" data-placement="right" title="Mark as accomplished">
                            <a href="#" class="btn btn-sm btn-success mb-1"
                            data-tracking="{$tracking}"
                            data-refer="{$_SERVER['REQUEST_URI']}"
                            data-manipulate="accomplish"
                            data-toggle="modal" 
                            data-target="#complete-doc"><i class="fa fa-check"></i></a>
                        </span>
                    </td>
                </tr>
ELLA;
                echo $ellacutie;
            }   
        }
    }
}

function get_received_today()
{
    $unit = $_SESSION['unit'];
    $prettyella = query("SELECT *, DATE_FORMAT(dl_receiveddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_receiveddate) = '" . currentdate() . "' AND dl_unit = {$unit}");
    echo shortNumber(row_count($prettyella));
}

function get_released_today()
{
    $unit = $_SESSION['unit'];
    $date = date('Y-m-d');
    $prettyella = query("SELECT *, DATE_FORMAT(dl_releaseddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_releaseddate) = '" . currentdate() . "' AND dl_releasedbyunit = {$unit}");
    echo shortNumber(row_count($prettyella));
}

function get_received_today_all()
{
    $prettyella = query("SELECT DISTINCT *, DATE_FORMAT(dl_receiveddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_receiveddate) = '" . currentdate() . "'");
    echo shortNumber(row_count($prettyella));
}

function get_released_today_all()
{
    $prettyella = query("SELECT DISTINCT *, DATE_FORMAT(dl_releaseddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_releaseddate) = '" . currentdate() . "'");
    echo shortNumber(row_count($prettyella));
}

function get_uploaded()
{
    $unit = $_SESSION['unit'];
    $myella = query("SELECT * FROM uploads WHERE up_unit = '{$unit}' ORDER BY id DESC");
    confirm($myella);

    while($row = fetch_array($myella))
    {
        $id = $row['id'];
        $filename = $row['up_filename'];
        $title = $row['up_title'];
        $action = $row['up_action'];
        $receivingUnit = get_unit_name($row['up_receivingunit']);
        $uploadedBy = get_user_name($row['up_by']);
        $uploadedUnit = get_unit_name($row['up_unit']);

        $date = format_date($row['up_dateadded']);

        $ellacutie = <<<ELLA
        <tr>
            <td><a href="./uploads/{$filename}" target="_blank">{$filename}</a></td>
            <td><a tabindex="0" class="btn btn-sm btn-default popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                data-content="
                Originating Office: {$uploadedUnit}
                <br>Uploaded by: {$uploadedBy}
                <br>Forwarded to: {$receivingUnit}
                <br>Date Uploaded: {$date}
                <hr>Action:<br>{$action}
                ">{$title}</a></td>
            <td>
                {$date}
            </td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function get_uploaded_shared()
{
    $unit = $_SESSION['unit'];
    $myella = query("SELECT * FROM uploads WHERE up_receivingunit = '{$unit}' ORDER BY id DESC");
    confirm($myella);

    while($row = fetch_array($myella))
    {
        $id = $row['id'];
        $filename = $row['up_filename'];
        $title = $row['up_title'];
        $action = $row['up_action'];
        $receivingUnit = get_unit_name($row['up_receivingunit']);
        $uploadedBy = get_user_name($row['up_by']);
        $uploadedUnit = get_unit_name($row['up_unit']);

        $date = format_date($row['up_dateadded']);

        $ellacutie = <<<ELLA
        <tr>
            <td><a href="./uploads/{$filename}" target="_blank">{$filename}</a></td>
            <td><a tabindex="0" class="btn btn-sm btn-default popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                data-content="
                Originating Office: {$uploadedUnit}
                <br>Uploaded by: {$uploadedBy}
                <br>Forwarded to: {$receivingUnit}
                <br>Date Uploaded: {$date}
                <hr>Action:<br>{$action}
                ">{$title}</a></td>
            <td>
                {$date}
            </td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function get_accomplished_count()
{
    $babyella = query("SELECT * FROM documents WHERE document_accomplished = 1 AND DATE(accomp_date) = '" . currentdate() . "' AND accomp_unit = '{$_SESSION['unit']}'");
    love($babyella);

    echo row_count($babyella);
}

function get_accomplished_docs()
{
    $babyella = query("SELECT * FROM documents WHERE document_accomplished = 1 AND accomp_unit = '{$_SESSION['unit']}' ORDER BY id DESC LIMIT " . ACC_QUERY_LIMIT);
    love($babyella);

    if(row_count($babyella) >= 1)
    {
        while($row = fetch_array($babyella))
        {
            $title = $row['document_title'];
            $desc = $row['document_desc'];
            $purpose = $row['document_purpose'];
            $tracking = $row['document_tracking'];

            $dateCreated = format_date($row['date_created']);
            $accompDate = format_date($row['accomp_date']);
            
            $origin = get_unit_name($row['document_origin']);
            $accompUnit = get_unit_name($row['accomp_unit']);
            $doctype = get_doctype_name($row['document_type']);
            $accompBy = get_user_name($row['accomp_by']);
            $owner = get_user_name($row['document_owner']);
            
            $ellacutie = <<<ELLA
            <tr>
                <td class="align-middle">
                    <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
                    <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                    {$tracking}
                </td>
                <td class="align-middle">{$title}</td>
                <td class="align-middle">{$purpose}</td>
                <td class="align-middle">{$doctype}</td>
                <td class="align-middle">{$dateCreated}</td>
                <td class="align-middle">{$accompDate}</td>
            </tr>
ELLA;
            echo $ellacutie;
        }
    }
}

function received_details($today, $start = 0, $end = 0)
{
    if($today == true)
    {
        $unit = $_SESSION['unit'];
        $prettyella = query(
            "SELECT * FROM docs_location WHERE 
             DATE(dl_receiveddate) = '" . currentdate() . "' 
             AND dl_unit = {$unit} 
             ORDER BY dl_id DESC"
        );
        confirm($prettyella);
    }
    else
    {
        $unit = $_SESSION['unit'];
        $prettyella = query(
            "SELECT * FROM docs_location
             WHERE DATE(dl_receiveddate) BETWEEN '{$start}' AND '{$end}' 
             AND dl_unit = {$unit} 
             ORDER BY dl_id DESC"
        );
        confirm($prettyella);
    }
    while($row = fetch_array($prettyella))
    {
        $tracking = $row['dl_tracking'];
        $title = get_document_detail($tracking, 'document_title');
        $purpose = get_document_detail($tracking, 'document_purpose');
        $doctype = get_doctype_name(get_document_detail($tracking, 'document_type'));
        $date = format_date(get_document_detail($tracking, 'date_created'));

        $receivedBy = get_user_name($row['dl_receivedby']);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle">
            <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
            <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                {$tracking}
            </td>
            <td class="align-middle">{$title}</td>
            <td class="align-middle">{$purpose}</td>
            <td class="align-middle">{$doctype}</td>
            <td class="align-middle">{$date}</td>
            <td class="align-middle">{$receivedBy}</td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function released_details($today, $start = 0, $end = 0)
{
    if($today == true)
    {
        $unit = $_SESSION['unit'];
        $prettyella = query(
            "SELECT * FROM docs_location WHERE 
             DATE(dl_releaseddate) = '" . currentdate() . "' 
             AND dl_releasedbyunit = {$unit} 
             ORDER BY dl_id DESC"
        );
        confirm($prettyella);
    }
    else
    {
        $unit = $_SESSION['unit'];
        $prettyella = query(
            "SELECT * FROM docs_location WHERE 
             DATE(dl_releaseddate) 
             BETWEEN '{$start}' AND '{$end}' 
             AND dl_releasedbyunit = {$unit} 
             ORDER BY dl_id DESC"
        );
        confirm($prettyella);
    }
    while($row = fetch_array($prettyella))
    {
        $tracking = $row['dl_tracking'];
        $title = get_document_detail($tracking, 'document_title');
        $purpose = get_document_detail($tracking, 'document_purpose');
        $doctype = get_doctype_name(get_document_detail($tracking, 'document_type'));
        $date = format_date(get_document_detail($tracking, 'date_created'));

        $releasedBy = get_user_name($row['dl_releasedby']);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle">
            <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
            <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                {$tracking}
            </td>
            <td class="align-middle">{$title}</td>
            <td class="align-middle">{$purpose}</td>
            <td class="align-middle">{$doctype}</td>
            <td class="align-middle">{$date}</td>
            <td class="align-middle">{$releasedBy}</td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function accomplished_details($today, $start = 0, $end = 0)
{
    if($today == true)
    {
        $unit = $_SESSION['unit'];
        $prettyella = query(
            "SELECT * FROM documents WHERE 
             DATE(accomp_date) = '" . currentdate() . "' 
             AND document_accomplished = 1 
             AND accomp_unit = '{$unit}' 
             ORDER BY id DESC"
        );
        confirm($prettyella);
    }
    else
    {
        $unit = $_SESSION['unit'];
        $prettyella = query(
            "SELECT * FROM documents WHERE 
             DATE(accomp_date) BETWEEN '{$start}' AND '{$end}' 
             AND document_accomplished = 1 
             AND accomp_unit = '{$unit}' 
             ORDER BY id DESC"
        );
        confirm($prettyella);
    }
    while($row = fetch_array($prettyella))
    {
        $tracking = $row['document_tracking'];
        $title = $row['document_title'];
        $purpose = $row['document_purpose'];
        $doctype = get_doctype_name($row['document_type']);
        $date = format_date($row['date_created']);

        $dateAccomp = format_date($row['accomp_date']);

        $ellacutie = <<<ELLA
        <tr>
            <td class="align-middle">
            <a href="?tracking={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Track"><i class="fa fa-search"></i></a>&nbsp;&nbsp;
            <a href="?print={$tracking}" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Tracking no."><i class="fa fa-print"></i></a>&nbsp;&nbsp;
                {$tracking}
            </td>
            <td class="align-middle">{$title}</td>
            <td class="align-middle">{$purpose}</td>
            <td class="align-middle">{$doctype}</td>
            <td class="align-middle">{$date}</td>
            <td class="align-middle">{$dateAccomp}</td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}

function getNumUsers()
{
    $loveElla = query("SELECT * FROM users");
    love($loveElla);

    echo shortNumber(row_count($loveElla));
}

function getNumDocs()
{
    $loveElla = query("SELECT * FROM documents");
    love($loveElla);

    echo shortNumber(row_count($loveElla));
}

function getLapsedNumDocs()
{
    $wStmt = "SELECT DISTINCT dl_tracking, dl_forwarded, DATE(dl_receiveddate) AS 'receiveddate', document_accomplished FROM docs_location, documents ";
    $wStmt .= "WHERE DATEDIFF('" . currentdate() . "', DATE(dl_receiveddate)) >= " . DOC_LAPSED_DAYS . " ";
    $wStmt .= "AND document_accomplished = 0 AND dl_forwarded = 0";
    $babyElla = query($wStmt);
    love($babyElla); // QUERY FOR LAPSED DOCS

    echo shortNumber(row_count($babyElla));
}

function docExists($tracking)
{
    $babyElla = query(
        "SELECT * FROM documents WHERE 
         document_tracking = '{$tracking}' LIMIT 1"
    );
    love($babyElla);

    if(row_count($babyElla) == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function isAccomplished($tracking)
{
    $babyElla = query(
        "SELECT * FROM documents WHERE 
         document_tracking = '{$tracking}' LIMIT 1"
    );
    love($babyElla);
    
    $row = fetch_assoc($babyElla);
    
    if($row['document_accomplished'] == 1)
    {
        return true;
    }

    return false;
}

function isPurged($tracking)
{
    $babyElla = query(
        "SELECT * FROM documents WHERE 
         document_tracking = '{$tracking}' LIMIT 1"
    );
    love($babyElla);
    
    $row = fetch_assoc($babyElla);
    
    if($row['document_accomplished'] == 3)
    {
        return true;
    }

    return false;
}

function exists($id, $table)
{
    $babyElla = query("SELECT * FROM {$table} WHERE id = '{$id}' LIMIT 1");
    love($babyElla);

    if(row_count($babyElla) == 1)
        return true;
    else
        return false;
}