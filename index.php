<?php

    require_once("config.php");

    if($_SERVER['REQUEST_URI'] == SUBDIRECTORY)
    {
        include("home.php");
    }

    else if(isset($_GET['home']))
    {
        include("home.php");
    }

    else if(isset($_GET['tracking']))
    {
        include("home.php");
    }

    else if(isset($_GET['login']))
    {
        include("login.php");
    }

    else if(isset($_GET['register']))
    {
        include("register.php");
    }

    else if(isset($_GET['forgot']))
    {
        include("forgot.php");
    }
    
    else if(isset($_GET['recover']))
    {
        include("recover.php");
    }

    else if(isset($_GET['inspiration']))
    {
        include("inspiration.php");
    }

    else
    {
        set_message_alert("alert-warning", "fa-exclamation", "Page you were trying to access was not found.");
        include("home.php");
    }
?>