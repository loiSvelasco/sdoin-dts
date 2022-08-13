<?php 

  $maintenance = false;
  $staging = false;

  include 'kint.phar';
  Kint::$aliases[] = 'dd';
  function dd(...$vars) { return die(Kint::dump(...$vars)); }

  $config = $staging ? "staging-dts-config.php" : "dts-config.php"; 
  require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . $config);
    
  /*
    
    VARIOUS FUNCTIONS USED
          functions.php       |   contains all the functions used for front-end generation
          managedoc.php       |   manages the receiving, releasing, and accomplishing documents
          manageperms.php     |   handles permissions when documents are lapsed
          administration.php  |   contains all administrator functions and queries
    
  */

  require_once("functions.php");
  require_once("managedoc.php");
  require_once("manageperms.php");
  require_once("administration.php");

?>