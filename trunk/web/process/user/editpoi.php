<?php
include_once '../../connection/databaseHandler.php';
include_once '../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$poiname = $_GET['poiname'];
echo $poiname;

?>
