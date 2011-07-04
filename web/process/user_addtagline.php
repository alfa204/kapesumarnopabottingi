<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();
    
    // Get informasi dari form
    $poiname = $_POST['poiname'];
    $tagline = $_POST['tagline'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $tagline_status = 1;
    
    // Get poi_id
    $query = "SELECT id FROM ".$database->t_poi." WHERE title='".$poiname."'";
    $result = $database->execQuery($query);
    while ($row = mysql_fetch_array($result)) {
        $poiid = $row['id'];
    }
    
    $query =
    "INSERT INTO ".$database->t_tagline."(
        poi_id,
        text,
        start_date,
        end_date,
        tagline_status_id
    ) VALUES (
        '".$poiid."',
        '".$tagline."',
        '".$awal."',
        '".$akhir."',
        '".$tagline_status."'
    )";
    
    if ($database->execQuery($query)) {
        //header("location:../index.php?ref=addTaglineSuccess");
    }
    else {
        //header("location:../index.php?ref=addTaglineFailed");
        die();
    }
?>
