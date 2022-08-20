<?php 
require_once("../../config.php");
echo row_count(query("SELECT * FROM users"));