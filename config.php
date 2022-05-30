<?php ob_start();
    
    /*
      
      AUTHOR:      LOUIS EUSEBIUS SUPERFICIAL VELASCO
      DATE:        MAY 2022
      PROJECT:     ENHANCED DOCUMENT TRACKING SYSTEM FOR SDOIN
      
     */
    
    
     session_start();

    //  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    /**
     * 
     * USER DEFINED CONSTANTS
     * THESE VALUES CAN BE CHANGED BASED ON NEEDS
     * 
     *       CONSTANT NAME      [DEFAULT VALUE]   TYPE      DESCRIPTION    
     *    -----------------------------------------------------------------------
     *      DASHBOARD_TITLE     eDTS | Dashboard  STRING    title shown on the tab window.
     *      ACC_QUERY_LIMIT     100               INT       # of rows to be shown on the accomplished documents table.
     *      DOC_QUERY_LIMIT     100               INT       # of rows to be shown on the created documents table.
     *      DOC_REMIND_DAYS     10                INT       # of days lapsed to show warning.
     *      DOC_LAPSED_DAYS     15                INT       # of days lapsed to disable adding documents.
     *      BASE_URL            none              STRING    root URL for the application
     *    -----------------------------------------------------------------------
     * 
     * THESE VALUES MUST NOT BE EMPTY, AND THESE VALUES ONLY AFFECT THE DASHBOARD (when the user is logged in).
     * THESE ARE ADDED TO AVOID SLOW LOAD TIMES.
     * 
     */

    define("DASHBOARD_TITLE", "eDTS | Dashboard");
    define("ACC_QUERY_LIMIT", 100);
    define("DOC_QUERY_LIMIT", 100);
    define("DOC_REMIND_DAYS", 10);
    define("DOC_LAPSED_DAYS", 15);
    define("BASE_URL", "localhost/sdoin-dts/");

    //  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -






    /*

      CONSTANTS BELOW MUST NOT BE CHANGED
      
     */

    // DATABASE CONSTANTS


    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "sdoin_dts");

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $numQueries = 0;

    define("HOST",      $_SERVER['HTTP_HOST'] . "/sdoin-dts/");
    define("BASE_HOST", $_SERVER['HTTP_HOST']);
    define("URI",       $_SERVER['REQUEST_URI']);
    define("URL",       HOST . URI);

    date_default_timezone_set('Asia/Manila');

    /*
      
      VARIOUS FUNCTIONS USED
           functions.php       |   contains all the functions used for front-end generation
           managedoc.php       |   manages the receiving, releasing, and accomplishing documents
           manageperms.php     |   handles when documents are lapsed
           administration.php  |   contains all administrator functions and queries
      
     */

    require_once("functions.php");
    require_once("managedoc.php");
    require_once("manageperms.php");
    require_once("administration.php");

?>
