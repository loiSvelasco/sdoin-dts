<?php 

/*
 * 
 *  HELPER FUNCTIONS
 *  Author: Louis Velasco
 *  Used for Procedural PHP
 * +
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
     echo $row['unit_name'];
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