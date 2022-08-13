<?php 

  $maintenance = false;

  include 'kint.phar';
  Kint::$aliases[] = 'dd';
  function dd(...$vars) { return die(Kint::dump(...$vars)); }

  // 
  require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . "dts-config.php");
    
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