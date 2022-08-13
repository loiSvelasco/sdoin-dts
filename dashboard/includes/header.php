<?php
  $start_time = microtime(true);
  // require("../config.php");
  if(!isset($_SESSION['user']))
  {
    set_message_alert("alert-warning", "fa-info-circle", "You need to sign in to continue.");
    redirect("../?login");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo DASHBOARD_TITLE ?></title>
  <link rel="icon" type="image/x-icon" href="./favicon.ico" />
  
  <!-- Dev Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
        
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->
  <script src="https://kit.fontawesome.com/8fb6d51646.js" crossorigin="anonymous"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css.php">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
</head>
<?php global $staging;  if($staging): ?>
  <div class="bg-warning d-flex justify-content-center position-sticky">
    <strong class="mt-1 mb-1">You are in a development environment. Changes here will not affect the live version.</strong>
  </div>
<?php endif; ?>
<body class="hold-transition sidebar-mini sidebar-collapse">
<!-- <div id="loading" class="spinner-border text-info" style="position:absolute; top:0; left:0; height:100%; width:100%; z-index:9999999;"></div> -->
<div id="loading"
style="position:absolute;
       width:100%;
       height: 100%;
       z-index:1;
       background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.1) 0%);">
       
  <div class="spinner-border text-info"
  style="position:absolute; 
         width: 6rem;
         height: 6rem;
         top:0;
         bottom:0;
         left:0;
         right:0;
         margin:auto;
         overflow:auto;">
  </div>
</div>

<!-- <body class="hold-transition sidebar-mini"> -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form action="?tracking" class="form-inline ml-3" method="GET">
      <div class="input-group input-group-md border border-info rounded">
        <input class="form-control form-control-navbar" type="search" name="tracking" placeholder="Tracking no." aria-label="Search" required>
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>&nbsp;&nbsp;Track
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $_SESSION['user']; ?><br><?php echo get_unit_name($_SESSION['unit']); ?></span>
          <div class="dropdown-divider"></div>
          <a href="?profile" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="?logout" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Log out
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-question-circle"></i></a>
      </li>
    </ul>
  </nav>