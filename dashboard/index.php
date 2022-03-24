<?php

include("includes/header.php");
include("includes/sidebar.php");

if($_SERVER['REQUEST_URI'] == "/sdoin-dts/dashboard/")
{
    include("includes/documents.php");
}

if(isset($_GET['documents']))
{
    include("includes/documents.php");
}

if(isset($_GET['reports']))
{
    include("includes/reports.php");
}

if(isset($_GET['tracking']))
{
    include("includes/tracking.php");
}

if(isset($_GET['logout']))
{
    include("actions/logout.php");
}

if(isset($_GET['manipulate']))
{
    include("actions/manipulate.php");
}

include("includes/modals.php");
include("includes/footer.php"); 

?>
