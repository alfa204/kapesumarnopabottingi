<?php
    include_once '../../connection/databaseHandler.php';
    include_once '../../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();
    
    $poi_id = $_GET['poi_id'];
    $tagline_status = 1;
    
    // Get informasi dari form
    $text = $_POST['text'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $query =
    "INSERT INTO ".$database->t_tagline."(
        poi_id,
        text,
        start_date,
        end_date,
        tagline_status_id
    ) VALUES (
        '".$poi_id."',
        '".$text."',
        '".$start."',
        '".$end."',
        '".$tagline_status."'
    )";
    
    if ($database->execQuery($query)) {
        //header("location:../index.php?ref=addTaglineSuccess");
        echo "add tagline berhasil";
    }
    else {
        //header("location:../index.php?ref=addTaglineFailed");
        //die();
        echo "add tagline gagal";
    }
?>
