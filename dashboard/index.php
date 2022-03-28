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

if(isset($_GET['profile']))
{
    include("includes/profile.php");
}

if(isset($_GET['scanrec']))
{
    include("includes/scanrec.php");
}

if(isset($_GET['logout']))
{
    include("actions/logout.php");
}

if(isset($_GET['manipulate']))
{
    include("actions/manipulate.php");
}

if(isset($_GET['print']))
{
    redirect("print/barcode.php?tracking=" . escape_string($_GET['print']));
}

include("includes/modals.php");
include("includes/footer.php"); 

?>
