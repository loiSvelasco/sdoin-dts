<?php ob_start();

session_start();
// session_destroy();

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "sdoin_dts");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$numQueries = 0;

define("HOST", $_SERVER['HTTP_HOST']);
define("URI", $_SERVER['REQUEST_URI']);
define("URL", HOST . URI);

date_default_timezone_set('Asia/Manila');

require_once("functions.php"); // various functions for front-end generation
require_once("managedoc.php"); // handles receiving, releasing, and accomplishing docs
require_once("manageperms.php"); // handles when docs are lapsed
require_once("administration.php"); // handles admin queries and functions

?>
