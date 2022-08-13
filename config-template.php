<?php ob_start();

    /*
    
      AUTHOR:      LOUIS EUSEBIUS SUPERFICIAL VELASCO
      DATE:        MAY 2022
      PROJECT:     ENHANCED DOCUMENT TRACKING SYSTEM FOR SDOIN

      ! PUT THIS FILE 1 DIRECTORY ABOVE THE ROOT FOLDER OF PROJECT.

    */

    session_start();
    define("SUBDIRECTORY", "/");


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
    define("ADMIN_ALL_LIMIT", 500);
    define("BASE_URL", "localhost" . SUBDIRECTORY);

    // db
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "");
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $numQueries = 0;

    define("HOST",      $_SERVER['HTTP_HOST'] . SUBDIRECTORY);
    define("BASE_HOST", $_SERVER['HTTP_HOST']);
    define("URI",       $_SERVER['REQUEST_URI']);
    define("URL",       HOST . URI);

    date_default_timezone_set('Asia/Manila');



?>