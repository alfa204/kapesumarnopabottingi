<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();
    
    // Get userid dari active user
    $query = "SELECT id FROM ".$database->t_poiuser." WHERE name='".$session->name."'";
    $result = $database->execQuery($query);
    while ($row = mysql_fetch_array($result)) {
        $userid = $row['id'];
    }
    
    // Get informasi dari form
    $title = $_POST['title'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
    $imageurl = $_POST['imageurl'];
    $imagefull = $_POST['imagefull'];
    $imagereduced = $_POST['imagereduced'];
    $imageicon = $_POST['imageicon'];
    $imagewiki = $_POST['imagewiki'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    
    // Set default poi status
    $poi_status = 1; /* 1=pending */
    
    $query =
    "INSERT INTO ".$database->t_poi."(
        user_id,
        title,
        lat,
        lon,
        imageURL,
        address,
        phone,
        email,
        tagline,
        image_full,
        image_reduced,
        image_icon,
        image_wiki,
        deskripsi,
        kategori,
        poi_status_id
    ) VALUES (
        '".$userid."',
        '".$title."',
        '".$lat."',
        '".$lon."',
        '".$imageurl."',
        '".$address."',
        '".$phone."',
        '".$email."',
        '".$tagline."',
        '".$imagefull."',
        '".$imagereduced."',
        '".$imageicon."',
        '".$imagewiki."',
        '".$deskripsi."',
        '".$kategori."',
        '".$poi_status."'
    )";
    
    if ($database->execQuery($query)) {
        header("location:../index.php?ref=addPoiSuccess");
    }
    else {
        header("location:../index.php?ref=addPoiFailed");
        die();
    }
?>
