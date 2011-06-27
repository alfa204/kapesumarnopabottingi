<?php
    include_once '../connection/databaseHandler.php';
    include_once '../connection/sessionHandler.php';
    $database = new DatabaseHandler();
    $session = new SessionHandler();
    
    // Get userid dari active user
    $query = "SELECT userid FROM ".$database->t_poiuser." WHERE name='".$session->name."'";
    $result = $database->execQuery($query);
    while ($row = mysql_fetch_array($result)) {
        $userid = $row['userid'];
    }
    
    // Get informasi dari form
    $title = $_POST['title'];
    $tagline = $_POST['tagline'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];
    $imageurl = $_POST['imageurl'];
    $imagefull = $_POST['imagefull'];
    $imagereduced = $_POST['imagereduced'];
    $imageicon = $_POST['imageicon'];
    $deskripsi = $_POST['deskripsi'];
    $kategori = $_POST['kategori'];
    
    $query =
    "INSERT INTO ".$database->t_poiapproval."(
        userid,
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
        deskripsi,
        kategori
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
        '".$deskripsi."',
        '".$kategori."'
    )";
    
    if ($database->execQuery($query)) {
        header("location:../index.php?ref=addPoiSuccess");
    }
    else {
        header("location:../index.php?ref=addPoiFailed");
        die();
    }
?>
