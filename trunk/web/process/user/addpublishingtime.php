<?php
    include_once '../../connection/databaseHandler.php';
    include_once '../../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();
    
    $poi_id = $_GET['poi_id'];
    
    // Get informasi dari form
    $label = $_POST['label'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $query =
    "INSERT INTO ".$database->t_waktutayang."(
        poi_id,
        label,
        start_date,
        end_date
    ) VALUES (
        '".$poi_id."',
        '".$label."',
        '".$start."',
        '".$end."'
    )";
    
    if ($database->execQuery($query)) {
        //header("location:../index.php?ref=addTaglineSuccess");
        echo "add publishing time berhasil";
    }
    else {
        //header("location:../index.php?ref=addTaglineFailed");
        //die();
       echo "add publishing time gagal";
    }
?>
