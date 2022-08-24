<?php 
require_once("../../config.php");

$user = $_SESSION['user_id'];
$json = $_POST['userWordle'];

$stmt = query(
    "UPDATE user_details 
     SET ud_wordle = '{$json} '
     WHERE id = {$user}"
);
confirm($stmt);
echo json_encode($stmt);