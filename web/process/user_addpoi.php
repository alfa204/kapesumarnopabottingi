<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();
    
    // Get userid dati active user
    $query = "SELECT userid FROM ".$database->t_poiuser." WHERE name='".$session->name."'";
    $result = $database->execQuery($query);
    while ($row = mysql_fetch_array($result)) {
        $userid = $row['userid'];
    }
    
    // Get informasi dari form
    $title = $_POST['title'];
    $attribution = $_POST['attribution'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
    $distance = 0.00;
    
    $query =
    "INSERT INTO ".$database->t_poi."(
        userid,
        attribution,
        title,
        lat,
        lon,
        distance
    ) VALUES (
        '".$userid."',
        '".$attribution."',
        '".$title."',
        '".$lat."',
        '".$lon."',
        '".$distance."'
    )";
    
    if ($database->execQuery($query)) {
        header("location:../index.php?ref=addPoiSuccess");
    }
    else {
        header("location:../index.php?ref=addPoiFailed");
        die();
    }
?>
