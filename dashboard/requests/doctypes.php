<?php 
require_once("../../config.php");

$query = query("SELECT * FROM doctypes ORDER BY doc_type ASC");
confirm($query);
$doctypes = '';
while($row = fetch_array($query))
{
    $doctypes .= "<li>{$row['doc_type']}</li>";
}

echo "<ul style='list-style-type:circle;'>" . $doctypes . "</ul>";


