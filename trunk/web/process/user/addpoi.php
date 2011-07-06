<?php
    include_once '../../connection/databaseHandler.php';
    include_once '../../connection/sessionHandler.php';
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
        '".$imagefull."',
        '".$imagereduced."',
        '".$imageicon."',
        '".$imagewiki."',
        '".$deskripsi."',
        '".$kategori."',
        '".$poi_status."'
    )";
    
    if ($database->execQuery($query)) {
        //header("location:../index.php?ref=addPoiSuccess");
        $used_id = mysql_insert_id();
        $label = $_POST['label'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        
        $query2 =
        "INSERT INTO ".$database->t_waktutayang." (
            poi_id,
            label,
            start_date,
            end_date
        ) VALUES (
            '".$used_id."',
            '".$label."',
            '".$start."',
            '".$end."'
        )";
        
        if ($database->execQuery($query2)) {
            //header("location:../index.php?ref=addPoiSuccess");
            echo "add waktu tayang success";
        } else {
            //header("location:../index.php?ref=addPoiFailed");
            //die();
            echo "add waktu tayang failed";
            echo mysql_error();
        }
    }
    else {
        header("location:../index.php?ref=addPoiFailed");
        die();
    }
?>
