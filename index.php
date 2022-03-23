<?php 
    if($_SERVER['REQUEST_URI'] == "/sdoin-dts/")
    {
        include("home.php");
    }

    if(isset($_GET['home']))
    {
        include("home.php");
    }

    if(isset($_GET['login']))
    {
        include("login.php");
    }

    if(isset($_GET['register']))
    {
        include("register.php");
    }

    if(isset($_GET['forgot']))
    {
        include("forgot.php");
    }
    
    if(isset($_GET['recover']))
    {
        include("recover.php");
    }

    if(isset($_GET['inspiration']))
    {
        include("inspiration.php");
    }
?>