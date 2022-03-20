<?php ob_start();

session_start();
// session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
// defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "admin/img");

defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS", "");
defined("DB_NAME") ? null : define("DB_NAME", "sdoin_dts");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

date_default_timezone_set('Asia/Manila');

require_once("functions.php");
require_once("managedoc.php");

?>
