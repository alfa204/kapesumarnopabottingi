<?php
    include_once '../../connection/databaseHandler.php';
    $database = new DatabaseHandler();

    $tagline_id = $_GET['tagline_id'];
    $text = $_POST['text'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $queryUpdate = "UPDATE ".$database->t_tagline."
                            SET
                                text='".$text."', start_date='".$start."', end_date='".$end."' 
                            WHERE
                                id = '$tagline_id'";
    $database->execQuery($queryUpdate);
    echo $queryUpdate;
    echo  'success';
?>
