<?php

include("includes/header.php");
include("includes/sidebar.php");

if($_SERVER['REQUEST_URI'] == "/sdoin-dts/dashboard/" || $_SERVER['REQUEST_URI'] == "/sdoin-dts/dashboard/?reports")
{
    include("includes/reports.php");
}

if(isset($_GET['documents']))
{
    include("includes/documents.php");
}

if(isset($_GET['logout']))
{
    include("actions/logout.php");
}

include("includes/modals.php");
include("includes/footer.php"); 

?>
