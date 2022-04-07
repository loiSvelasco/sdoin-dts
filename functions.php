<?php

/*
 *
 *  HELPER FUNCTIONS
 *  Author: Louis Velasco
 *  Used for Procedural PHP
 *
 */

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

/*
 *
 *  FRONT END FUNCTIONS
 *
 */

function get_unit_do()
{
    $sql = query("SELECT * FROM units WHERE unit_type = 'Division Office'");
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

function get_unit_heads()
{
    $sql = query("SELECT * FROM units WHERE unit_type = 'Division Office' AND unit_head = 1 AND unit_id != {$_SESSION['unit']}");
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

        $cutie = <<<ELLA
        <option value="{$unit_id}">{$unit_name}</option>
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

        $option = <<<ELLA
        <option value="{$unit_id}">{$unit_name}</option>
ELLA;
        echo $option;
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

function get_owner_name($id)
{
    $printetella = query("SELECT * FROM user_details WHERE ud_id = {$id}");
    confirm($printetella);
    
    $row = fetch_assoc($printetella);
    return $row['ud_name'];
}

function get_my_docs()
{
    $ella = query("SELECT * FROM documents WHERE document_origin = {$_SESSION['unit']} ORDER BY id DESC");
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $doctype = get_doctype_name($row['document_type']);
        $origin = get_unit_name($row['document_origin']);
        $owner = get_owner_name($row['document_owner']);
        $title = $row['document_title'];
        $desc = $row['document_desc'];
        $purpose = $row['document_purpose'];
        $tracking = $row['document_tracking'];
        $id = $row['id'];

        $ellacutie = <<<ELLA
        <tr>
            <td data-visible="false">$id</td>
            <td>{$tracking}</td>
            <td>{$title}</td>
            <td>{$doctype}</td>
            <td>{$owner}</td>
            <td>
                <a href="?print={$tracking}" target="_blank" class="text-decoration-none btn btn-warning" data-toggle="tooltip" data-placement="left" title="Print Tracking no."><i class="fa fa-print"></i></a>
                <a href="?tracking={$tracking}" target="_blank" class="text-decoration-none btn btn-success" data-toggle="tooltip" data-placement="right" title="Track"><i class="fa fa-search"></i></a>
            </td>
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
        return $row['dl_unit'];
    }
    else
    {
        // throw an error
    }
}

function get_to_receive()
{
    $ella = query("SELECT * FROM docs_location WHERE dl_unit = {$_SESSION['unit']} AND dl_receivedby = 0 ORDER BY dl_id ASC");
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
        confirm($bbyella);

        $id = $row['dl_id'];

        while($docRow = fetch_array($bbyella))
        {
            $doctype = get_doctype_name($docRow['document_type']);
            $origin = get_unit_name($docRow['document_origin']);
            $owner = get_owner_name($docRow['document_owner']);
            $title = $docRow['document_title'];
            $desc = $docRow['document_desc'];
            $purpose = $docRow['document_purpose'];
            $tracking = $docRow['document_tracking'];

            $phpdate = strtotime($docRow['date_created']);
            $date = date("F j, Y, g:i a", $phpdate );
    
            $ellacutie = <<<ELLA
            <tr>
                <td class="text-center"><input type="checkbox" name="rec-check[]" value="{$tracking}" class="receiveBox" form="receive">&nbsp;&nbsp;</td>
                <td class="text-center">{$tracking}</td>
                <td><a tabindex="0" class="btn btn-sm btn-default popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                    data-content="
                    Type: {$doctype}
                    <br>Origin: {$origin}
                    <br>Owner: {$owner}
                    <hr>Date Created:<br>{$date}
                    ">{$title}</a></td>
                <!-- <td>{$doctype}</td>
                <td>{$owner}</td> -->
                <td class="text-center">
                    <a href="?manipulate=receive&tracking={$tracking}&refer={$_SERVER['REQUEST_URI']}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Receive"><i class="fa fa-file-import"></i></a>
                </td>
            </tr>
ELLA;
            echo $ellacutie;
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
    // $ella = query("SELECT * FROM docs_location WHERE dl_unit = {$_SESSION['unit']} AND dl_accomplished = 0 AND dl_receivedby != 0 ORDER BY dl_id DESC");
    $ella = query("SELECT DISTINCT dl_tracking, dl_id FROM docs_location WHERE dl_unit = {$_SESSION['unit']} AND dl_receivedby != 0 AND dl_forwarded = 0 ORDER BY dl_id DESC");
    confirm($ella);

    while($row = fetch_array($ella))
    {
        $bbyella = query("SELECT * FROM documents WHERE document_tracking = '{$row['dl_tracking']}' AND document_accomplished = 0");
        confirm($bbyella);

        $id = $row['dl_id'];

        while($docRow = fetch_array($bbyella))
        {
            $doctype = get_doctype_name($docRow['document_type']);
            $origin = get_unit_name($docRow['document_origin']);
            $owner = get_owner_name($docRow['document_owner']);
            $title = $docRow['document_title'];
            $desc = $docRow['document_desc'];
            $purpose = $docRow['document_purpose'];
            $tracking = $docRow['document_tracking'];

            $phpdate = strtotime($docRow['date_created']);
            $date = date("F j, Y, g:i a", $phpdate );
    
            $ellacutie = <<<ELLA
            <tr>
                <td class="text-center"><input type="checkbox" name="rel-check[]" form="release" class="releaseBox" value="{$tracking}">&nbsp;&nbsp;</td>
                <td class="text-center">{$tracking}</td>
                <td><a tabindex="0" class="btn btn-sm btn-default popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                data-content="
                Type: {$doctype}
                <br>Origin: {$origin}
                <br>Owner: {$owner}
                <hr>Date Created: <br>{$date}
                ">{$title}</a></td>
                <!--<td>{$doctype}</td>
                <td>{$owner}</td>-->
                <td class="text-center">
                    <span data-toggle="tooltip" data-placement="left" title="Release"><button data-toggle="modal" data-target="#modal-release-doc" class="btn btn-sm btn-info release_doc"><i class="fa fa-file-export white"></i></button></span>
                    <!-- <a href="?manipulate=receive&tracking={$tracking}&unit={$_SESSION['unit']}&by={$_SESSION['user_id']}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="right" title="Mark as Done"><i class="fa fa-check"></i></a> -->
                    <span data-toggle="tooltip" data-placement="right" title="Mark as accomplished">
                        <a href="#" class="btn btn-sm btn-success" data-href="?manipulate=accomplish&tracking={$tracking}&unit={$_SESSION['unit']}&by={$_SESSION['user_id']}" data-toggle="modal" data-target="#complete-doc"><i class="fa fa-check"></i></a>
                    </span>
                </td>
            </tr>
ELLA;
            echo $ellacutie;
        }
    }
}

function get_received_today()
{
    $unit = $_SESSION['unit'];
    $prettyella = query("SELECT *, DATE_FORMAT(dl_receiveddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_receiveddate) = CURDATE() AND dl_unit = {$unit}");
    echo row_count($prettyella);
}

function get_released_today()
{
    $unit = $_SESSION['unit'];
    // $prettyella = query("SELECT *, DATE_FORMAT(dl_releaseddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_releaseddate) = CURDATE() AND dl_forwarded = 1 AND dl_unit = '{$unit}'");
    $prettyella = query("SELECT *, DATE_FORMAT(dl_releaseddate, '%Y-%m-%d')  FROM docs_location WHERE DATE(dl_releaseddate) = CURDATE() AND dl_releasedbyunit = {$unit}");
    echo row_count($prettyella);
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
        $uploadedBy = get_owner_name($row['up_by']);
        $uploadedUnit = get_unit_name($row['up_unit']);

        $phpdate = strtotime($row['up_dateadded']);
        $date = date("F j, Y, g:i a", $phpdate );


        $ellacutie = <<<ELLA
        <tr>
            <td class="text-center">{$filename}</td>
            <td><a tabindex="0" class="btn btn-sm btn-default popover-dismiss" role="button" data-toggle="popover" data-html="true" data-trigger="focus" title="Document Details"
                data-content="
                Originating Office: {$uploadedUnit}
                <br>Uploaded by: {$uploadedBy}
                <br>Forwarded to: {$receivingUnit}
                <br>Date Uploaded: {$date}
                <hr>Action:<br>{$action}
                ">{$title}</a></td>
            <td class="text-center">
                <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="left" title="Receive"><i class="fa fa-file-import"></i></a>
            </td>
        </tr>
ELLA;
        echo $ellacutie;
    }
}