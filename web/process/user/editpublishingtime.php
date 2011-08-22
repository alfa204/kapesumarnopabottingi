<?php
include_once '../../connection/databaseHandler.php';
include_once '../../connection/sessionHandler.php';
$database = new DatabaseHandler();
$session = new SessionHandler();

$publishingtime_id = $_GET['publishingtime_id'];

// Get informasi dari form
$label = $_POST['label'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = "
    UPDATE ".$database->t_waktutayang." SET 
    label='".$label."',
    start_date='".$start_date."',
    end_date='".$end_date."' 
    WHERE id='".$publishingtime_id."'";
$result = $database->execQuery($query);

if ($result) {
    echo "edit waktu tayang BERHASIL";
} else {
    echo "edit waktu tayang GAGAL";
}
?>
