<?php ob_start();

session_start();
// session_destroy();

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "sdoin_dts");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

define("HOST", $_SERVER['HTTP_HOST']);
define("URI", $_SERVER['REQUEST_URI']);
define("URL", HOST . URI);

date_default_timezone_set('Asia/Manila');

require_once("functions.php");
require_once("managedoc.php");

?>
