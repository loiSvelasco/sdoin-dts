<?php

include("includes/header.php");
include("includes/sidebar.php");

// !  Role Assignment
// *  1 = superadmin
// *  2 = admin / special accounts
// *  3 = regular user


// session_start();
if(isset($_SESSION['timestamp']))
{
    if(time() - $_SESSION['timestamp'] > 900)
    {
        redirect("?logout");
    }
    else
    {
        $_SESSION['timestamp'] = time();
    }
}


if(isset($_GET['admin']))
{
    if($_SESSION['role'] == 1)
    {   
        include("includes/admin.php");   
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }    
}

if(isset($_GET['upload']))
{
    if($_SESSION['role'] == 2 || $_SESSION['role'] == 1 )
    {   
        include("includes/upload.php");   
    }
    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "Access Denied.");
        redirect("./?documents");
    }    
}

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
